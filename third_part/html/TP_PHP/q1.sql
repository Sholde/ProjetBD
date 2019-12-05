CREATE TABLE candidats(
    CandidatId INT,
    Nom varchar(20),
    Prenom varchar(20),
    PRIMARY KEY(CandidatId)
);

CREATE TABLE votants(
    VotantId INT,
    Nom varchar(20),
    Prenom varchar(20),
    Pass_word varchar(10),
    PRIMARY KEY(VotantId)
);

CREATE TABLE vote(
	VotantId INT,
    CandidatId INT,
    PRIMARY KEY(VotantId, CandidatId)
);
