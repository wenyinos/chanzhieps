#!/bin/bash
git archive --format=zip --output=code.zip master
rm -rf /tmp/chanzhirelease
mkdir /tmp/chanzhirelease
mv code.zip /tmp/chanzhirelease
cd /tmp/chanzhirelease
unzip code.zip
rm /tmp/chanzhirelease/code.zip
make
