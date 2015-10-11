#!/bin/csh

latex cv_steve-steele.tex
#sleep 1
latex cv_steve-steele.tex
#sleep 1
latex cv_steve-steele.tex
#sleep 1
dvipdf cv_steve-steele
acroread cv_steve-steele.pdf &

exit
