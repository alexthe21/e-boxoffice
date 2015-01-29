# e-boxoffice
This application is still under construction. It may be subjected to change at any time.

## Installation

1. Open a terminal.
2. $ cd the/convenient/path
3. $ git clone https://github.com/alexthe21/e-boxoffice.git
4. $ cd e-boxoffice
5. Create a specific database for the webapp. I named it 'eboxoffice'.
6. $ composer update
7. Follow fulfil the data required.
8. $ php app/console doctrine:schema:update --force
9. $ php app/console doctrine:fixtures:load
10. $ php app/console server:run
11. Open a new terminal.
12. $ cd the/convenient/path/e-boxoffice
13. $ php app/console at21:eboxoffice:server:run
14. Open a browser and enter 'http://localhost:8000'
15. Use user: 'admin' password: 'admin' to carry out administrator operations.
16. Use user: 'user1' password: 'user1' to carry out plain user operations.
