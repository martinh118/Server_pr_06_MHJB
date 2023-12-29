DROP DATABASE IF EXISTS `pt06_martin_jaime`;

CREATE DATABASE IF NOT EXISTS `pt06_martin_jaime`;
USE `pt06_martin_jaime`;


CREATE TABLE IF NOT EXISTS `articles`(
    ID MEDIUMINT NOT NULL,
    titulo text NOT NULL,
    article text NOT NULL,
    autor text NOT NULL,
    rutaImagen VARCHAR(150) DEFAULT '../src/claqueta_accion.png',
    PRIMARY KEY (ID)
);


CREATE TABLE IF NOT EXISTS `users`(
    ID MEDIUMINT NOT NULL AUTO_INCREMENT,
    nom_usuari text NOT NULL,
    email_usuari text NOT NULL,
    contra VARCHAR(512) NOT NULL,
    token VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO `articles`(`ID`, `titulo`, `article`, `autor`, `rutaImagen`) VALUES
(0, 'Bienvenido','¡Hola mundo!', 'public', '../src/claqueta_accion.png'), 
(1, 'El padrino','Voy a hacerle una oferta que no podrá rechazar', 'public', '../src/el_padrino.jpg'),
(2,'Star Wars' ,'Que la fuerza te acompañe', 'public', '../src/star_wars.jpg'),
(3, 'Taxi driver','¿Hablas conmigo?', 'public', '../src/taxi_driver.jpg'),
(4, 'Apocalypse Now','Qué delicia oler napalm por la mañana', 'public', '../src/apocalypse_now.jpg'),
(5, 'E.T.','E.T., teléfono, mi casa', 'public', '../src/et.jpg'),
(6, 'Blade Runner','¿Es dura la experiencia de vivir con miedo, verdad? En eso consiste ser esclavo', 'public', '../src/blade_runner.jpg'),
(7,'Forrest Gump','Puede que no sea muy listo, pero sé lo que es el amor', 'public', '../src/forrest_gump.jpg'),
(8, 'Amelie','La vida no es más que un interminable ensayo, de una obra que jamás se va a estrenar', 'public', '../src/amelie.jpg'),
(9,'El Rey Leon','Oh, sí... El pasado puede doler, pero tal como yo lo veo puedes huir de él o aprender', 'public', '../src/el_rey_leon.jpg'),
(10, 'El gran dictador','Pensamos demasiado y sentimos muy poco…', 'public', '../src/el_gran_dictador.jpg'),
(11, 'El señor de los anillos','Sólo tú puedes decidir qué hacer con el tiempo que se te ha dado', 'public', '../src/el_señor_de_los_anillos.webp'),
(12, 'Harry Potter','No son las habilidades lo que demuestra lo que somos, son nuestras decisiones', 'public', '../src/harry_potter.jpg'),
(13, 'Nemo','Sigue nadando', 'public' , '../src/nemo.jpg'),
(14, 'American History X','Mi conclusión es que el odio es un lastre. La vida es demasiado corta para estar siempre cabreado', 'public', '../src/american-history-x.webp'),
(15, 'El curioso caso de Benjamin Button','Todas las oportunidades marcan el transcurso de nuestra vida, incluso las que dejamos ir', 'public', '../src/benjamin_button.jpg'),
(16,'Gladiator','La muerte nos sonríe a todos. Devolvámosle la sonrisa', 'public', '../src/gladiator.jpg'),
(17,'Abierto hasta el amanecer','No es un problema grave si no lo conviertes en un problema grave', 'public', '../src/Abierto_hasta_el_amanecer.webp'),
(18,'La teoría del todo','Por muy dura que nos parezca la vida, mientras haya vida hay esperanza', 'public', '../src/la_teoria_del_todo.jpg'),
(19,'Alicia en el País de las Maravillas','Alicia, no puedes vivir complaciendo a otros, la decisión es completamente tuya', 'public', '../src/alicia.jpg'),
(20,'El lobo de Wall Street','Lo único que está entre tu meta y tú, es la historia que te sigues contando a ti mismo de por qué no puedes lograrla', 'public', '../src/lobo_wall_street.webp'),
(21, 'Martín H. Jaime','¿Cauntas bombillas harán falta para cambiar a un electricista de su puesto de trabajo?', 'public', '../src/claqueta_accion.png');
