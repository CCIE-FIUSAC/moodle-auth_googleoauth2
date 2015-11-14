#!/bin/bash
# Modificar variables
destino=/mnt/memo
zip=auth_googleoauth2_moodle28_2015111401.zip

cd ..
cp -r moodle-auth_googleoauth2 $destino
cd $destino
rm $zip
mv moodle-auth_googleoauth2 googleoauth2
rm -rf googleoauth2/metadata googleoauth2/.git googleoauth2/.gitignore googleoauth2/*.sh
zip -r $zip googleoauth2
rm -rf googleoauth2
