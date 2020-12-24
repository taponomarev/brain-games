install:
	composer install
validate:
	composer validate

autoload:
	composer dump-autoload	

brain-games:
	./bin/brain-games

brain-even:
	./bin/brain-even

brain-calc:
	./bin/brain-calc

brain-gcd:
	./bin/brain-gcd	

brain-prime:
	./bin/brain-prime

brain-progression:
	./bin/brain-progression

lint:
	composer run-script phpcs -- --standard=PSR12 src bin	