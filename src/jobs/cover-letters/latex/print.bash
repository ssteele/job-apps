#!/bin/bash

filename='cover_steve-steele'

./latex.bash
open -a /Applications/Adobe\ Acrobat\ Reader\ DC.app/ ${filename}.pdf &

exit
