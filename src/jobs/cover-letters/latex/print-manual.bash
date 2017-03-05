#!/bin/bash

# set variables
filename='cover_steve-steele'

# driver
./generate-manual.bash
open -a /Applications/Adobe\ Acrobat\ Reader\ DC.app/ ${filename}.pdf &

exit
