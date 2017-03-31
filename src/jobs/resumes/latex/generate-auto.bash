#!/bin/bash

# set variables
filename='cv_steve-steele'

# define commands
latexPath='/Library/TeX/texbin'
latex="${latexPath}/latex"
dvipdf="${latexPath}/dvipdfm"

if [[ -n "$1" ]]; then
    canonicalFilename="$1"

    # currently in ajax folder... navigate to where this script lives
    directory="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
    cd $directory

    # remove existing generated assets
    rm -fr ${filename}.pdf
    rm -fr ${filename}.dvi
    rm -fr ${filename}.aux
    rm -fr ${filename}.out
    rm -fr ${filename}.log

    # driver
    ${latex} ${filename}.tex >/dev/null 2>&1
    ${latex} ${filename}.tex >/dev/null 2>&1
    ${latex} ${filename}.tex >/dev/null 2>&1
    ${dvipdf} ${filename} >/dev/null 2>&1

    if [ -e ${filename}.dvi ] && [ -s ${filename}.dvi ]; then
        if [ -e ${filename}.pdf ] && [ -s ${filename}.pdf ]; then

            # if .dvi and .pdf documents exist and are non-empty...
            cp -f ${filename}.pdf ../${canonicalFilename}.pdf
            cp -f ${filename}.tex ../${canonicalFilename}.tex

            # return true
            echo 'Document generated'
        else
            echo 'Failed to generate PDF'
        fi
    else
        echo 'Failed to generate DVI'
    fi
else
    echo 'No filename received'
fi

exit
