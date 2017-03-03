#!/bin/bash

filename='cover_steve-steele'

latex ${filename}.tex
latex ${filename}.tex
latex ${filename}.tex

dvipdf ${filename}

exit
