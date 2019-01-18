#!/usr/bin/env bash
LARADOCK_DIR="./laradock_nanfl"
SETUP_DIR="./setup"

echo "Copying desired docker-compose.yml file..."
cp $SETUP_DIR/docker-compose.yml $LARADOCK_DIR/

echo "Copying desired docker .env file..."
cp $SETUP_DIR/env-example $LARADOCK_DIR/.env

echo "Complete.  Ready to run initial docker setup."