DROP TABLE IF EXISTS competitions; 
DROP TABLE IF EXISTS criteria;
DROP TABLE IF EXISTS judges;
DROP TABLE IF EXISTS participants;
DROP TABLE IF EXISTS judges_levels;
DROP TABLE IF EXISTS participant_levels;
DROP TABLE IF EXISTS scores;

create table competitions(
    id INT not null AUTO_INCREMENT,
    competition_name varchar(50),
    PRIMARY key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table IF NOT EXISTS levels(
    id INT not null AUTO_INCREMENT,
    level varchar(200),
    active INT DEFAULT 1,
    PRIMARY key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table criteria(
    id INT not null AUTO_INCREMENT,
    criteria varchar(200),
    level_id int,
    PRIMARY key (id),
    FOREIGN KEY (level_id) REFERENCES levels (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table judges(
    id INT not null AUTO_INCREMENT,
    judge_name varchar(50),
    username varchar(20),
    password varchar(20),
    PRIMARY key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table participants(
    id INT not null AUTO_INCREMENT,
    first_name varchar(50),
    last_name varchar(50),
    dob varchar(50),
    gender varchar(10),
    competition_id INT,
    level_id INT,
    FOREIGN KEY (competition_id) REFERENCES competitions (id),
    FOREIGN KEY (level_id) REFERENCES levels (id),
    PRIMARY key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table judges_levels(
    judge_id INT,
    level_id INT,
    competition_id INT,
    FOREIGN KEY (judge_id) REFERENCES judges (id),
    FOREIGN KEY (level_id) REFERENCES levels (id),
    FOREIGN KEY (competition_id) REFERENCES competitions (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table scores(
	id INT,
	participant_id INT,
	criteria_id INT,
	score INT,
	FOREIGN KEY (participant_id) REFERENCES participants (id),
	FOREIGN KEY (criteria_id) REFERENCES criteria (id),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




