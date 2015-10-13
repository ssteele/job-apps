#!/bin/csh

latex cover_steve-steele.tex
latex cover_steve-steele.tex
latex cover_steve-steele.tex

# # If xdvi enabled
# xdvi cover_steve-steele.dvi &

# # W2O laptop (this isn't rendering html links w/in the document: need hyperref lib?)...
# dvipdfmx cover_steve-steele

# Home...
dvipdf cover_steve-steele

# Display
acroread cover_steve-steele.pdf &

exit
