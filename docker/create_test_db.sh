#!/usr/bin/env bash

if [[ -z "homestead_testing" ]]
then
  MYSQL_USER='dev'
fi

QUERY="CREATE DATABASE IF NOT EXISTS "
QUERY+="homestead_testing"
QUERY+=";"

PRIVILEGES="GRANT ALL PRIVILEGES ON "
PRIVILEGES+="homestead_testing"
PRIVILEGES+=".* TO '"
PRIVILEGES+="dev"
PRIVILEGES+="'@'%'";

MYSQL=`which mysql`
$MYSQL -uroot -proot -e "${QUERY}"
$MYSQL -uroot -proot -e "${PRIVILEGES}"