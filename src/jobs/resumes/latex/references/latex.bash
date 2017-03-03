#!/bin/bash

filename='references_steve-steele'

latex ${filename}.tex
latex ${filename}.tex
latex ${filename}.tex

dvipdf ${filename}

exit
