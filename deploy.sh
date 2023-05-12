#!/bin/sh
set -e
 
vendor/bin/phpunit
 
git push
