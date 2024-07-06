A typical CRUD application example.

Features:
- Create Article
- Show articles in list
- Show single article
- Update article
- Delete article
- Dependency injections
- Logging
- Twig
- Tailwind CSS
- FastRoute

as of 07.07.2024. new features added:
- Option to leave a comment (name, comment)
- Display comments under article
- Delete comment (its fine that there are no users)

- Comment can be "liked" (right now its fine you can infinite thumbs up the comment)
- Article can be "liked" (the same rules as above)

Project created as Codelex bootcamp assignment.

Assignment Requirements:
Create a website where you can manage and display "articles"
There should be following options

- Show list of articles
- Display single article
- Create new article
- Update article
- Delete article

This should be also visually formatted using TailwindCSS
Logging options should be implemented using https://github.com/Seldaek/monolog
Dependency injection usage is MUST - https://php-di.org/

Setup:
- ```git clone https://github.com/ambivalent-axiom/articleWebsite.git```
- ```composer install```
- ```php -S localhost:8000```
- Open ```localhost:8000``` in web browser.

-- END OF readme.md --