#!/bin/bash

# CreateDBUser.sh
# Parameter: If no parameter, it uses in home of the user.
# Else, it specifies the path of the credentials file.

SEARCHKEY="DBPassword"
DBUSER="mynumber_admin"
DBNAME="mynumber_db"

CURRENTDIR=$(cd $(dirname "$0"); pwd)

CREDFILE="${HOME}/.im/credentials"
if [ ! -f ${CREDFILE} ] ; then
  CREDFILE="/var/www/.im/credentials"
  if [ ! -f ${CREDFILE} ] ; then
    CREDFILE="/.im/credentials"
  fi
fi
if [ -n "${1}" ] ; then
  CREDFILE="${1}"
fi
if [ ! -f ${CREDFILE} ] ; then
  echo "Credential file ${CREDFILE} not found."
  exit 1
fi

echo "Read from file '${CREDFILE}'."
while read LINE
do
  if [[ "${LINE}" == "${SEARCHKEY}"* ]]; then
    PW=$(echo ${LINE:12})
  fi
done < ${CREDFILE}

if [ -z ${PW} ] ; then
  echo "Can't get the password from ${CREDFILE}."
  exit 1
fi

sudo mysql -uroot -e "DROP DATABASE IF EXISTS ${DBNAME};"
sudo mysql -uroot -e "CREATE DATABASE ${DBNAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

sudo mysql -uroot -e "CREATE USER IF NOT EXISTS '${DBUSER}'@'localhost' IDENTIFIED BY '${PW}';"
sudo mysql -uroot -e "GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE ${DBNAME}.* TO '${DBUSER}'@'localhost';"
sudo mysql -uroot -e "GRANT SHOW VIEW ON TABLE ${DBNAME}.* TO '${DBUSER}'@'localhost';"

sudo mysql -uroot "${DBNAME}" < ${CURRENTDIR}/schema.sql
