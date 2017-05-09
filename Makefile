SRC=src
DIST=dist
LATEXMK=docker-compose run --rm fithesis3 latexmk
LATEXMK_PDF=$(LATEXMK) -output-directory=$(DIST) -f -pdf -r .latexmkrc.pl
CHAPTERS=$(wildcard $(SRC)/chapters/*.tex)

all: $(DIST)/thesis.pdf

$(DIST)/%.pdf: $(SRC)/%.tex $(CHAPTERS) $(SRC)/citations.bib $(SRC)/glossary.tex
	$(LATEXMK_PDF) $<

.PHONY: clean

clean:
	cd $(DIST) && rm -f *.pdf *.aux *.bib *.bbl *.bcf *.blg *.log *.out *.pyg *.run.xml \
		*.toc *.fls *.idx *.lof *.lot *.fdb_latexmk *.ilg *.ind *.gz

.PHONY: watch

watch:
	make clean;
	while true; do \
		make; \
		inotifywait --recursive -q -e close_write $(SRC) $(SRC)/chapters; \
	done
