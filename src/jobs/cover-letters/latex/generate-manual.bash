#!/bin/bash

# set variables
filename='cover_steve-steele'

# driver
latex ${filename}.tex
latex ${filename}.tex
latex ${filename}.tex
dvipdf ${filename}

echo 'Document generated'

exit
