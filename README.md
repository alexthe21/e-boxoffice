# e-boxoffice

## Installation

1. Open a terminal
2. $ cd the/convenient/path
3. $ git clone https://github.com/alexthe21/e-boxoffice.git
4. $ cd e-boxoffice
5. $ composer update
6. $ php app/console doctrine:schema:update --force
7. $ php app/console doctrine:fixtures:load
8. $ php app/console server:run
9. $ php app/console at21:eboxoffice:server:run
10. Open a browser and enter 'http://localhost:8000'
11. Use user: 'admin' password: 'admin' to carry out administrator operations
12. Use user: 'user1' password: 'user1' to carry out plain user operations
