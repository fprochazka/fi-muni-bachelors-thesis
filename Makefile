SRC=src
DIST=dist
PDFLATEX=docker-compose run --rm fithesis3 pdflatex -interaction=nonstopmode -shell-escape -output-directory=$(DIST)
CHAPTERS=$(wildcard $(SRC)/chapters/*.tex)

all: $(DIST)/thesis.pdf

$(DIST)/%.pdf: $(SRC)/%.tex $(CHAPTERS)
	$(PDFLATEX) $<

.PHONY: clean

clean:
	rm -f $(DIST)/thesis.*

.PHONY: watch

watch:
	while true; do \
		make; \
		inotifywait --recursive -q -e close_write $(SRC) $(SRC)/chapters; \
	done
