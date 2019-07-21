#!/bin/bash

# set variables
filename='cv_steve-steele'

# define commands
latexPath='/Library/TeX/texbin'
latex="${latexPath}/latex"
dvipdf="${latexPath}/dvipdfm"

# driver
${latex} ${filename}.tex >/dev/null 2>&1
${latex} ${filename}.tex >/dev/null 2>&1
${latex} ${filename}.tex >/dev/null 2>&1
${dvipdf} ${filename} >/dev/null 2>&1

echo 'Document generated'

exit
