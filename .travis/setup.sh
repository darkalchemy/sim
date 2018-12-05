#!/bin/bash

if [ $DB == 'sqlite' ] || [ $DB == 'postgres' ]; then
  if [ $DB == 'postgres' ]; then
    psql -c 'create database sim_prod;' -U postgres
    cp .env.postgresql .env
  fi
else
  sh -c "mysql -e 'CREATE DATABASE sim_prod;'"
  cp .env.mysql .env
fi
