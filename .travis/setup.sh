#!/bin/bash

if [ $DB == 'sqlite' ] || [ $DB == 'postgres' ]
  if [ $DB == 'postgres' ]
    psql -c 'create database sim_prod;' -U postgres
    cp .env.postgresql .env
  fi
else
  sh -c "mysql -e 'CREATE DATABASE sim_prod;'"
  cp .env.mysql .env
fi
