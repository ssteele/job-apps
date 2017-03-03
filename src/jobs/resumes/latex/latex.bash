#!/bin/bash

filename='cv_steve-steele'

latex ${filename}.tex
latex ${filename}.tex
latex ${filename}.tex

dvipdf ${filename}

exit
