CREATE TABLE `Users`
(
    `userID`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `userName`      VARCHAR(255) NOT NULL,
    `userPasswd`    TEXT         NOT NULL,
    `role`          TEXT         NOT NULL,
    PRIMARY KEY (`userID`)
) COLLATE='utf8_polish_ci'
;
CREATE TABLE `Links`
(
    `linkID`        INT UNSIGNED         NOT NULL AUTO_INCREMENT,
    `ogVersion`     TEXT                 NOT NULL,
    `shortVersion`  VARCHAR(255)         NOT NULL,
    `linkPasswd`    VARCHAR(255)         NOT NULL,
    `createDate`    DATETIME        NOT NULL,
    `editDate`      DATETIME        NOT NULL,
    `lastVisitDate` DATETIME        NOT NULL,
    `numOfVisits`   INT UNSIGNED         NOT NULL,
    `lifetime`      DATETIME        NOT NULL,
    `userID`        INT UNSIGNED         NOT NULL,
    PRIMARY KEY (`linkID`),
    FOREIGN KEY (`userID`) REFERENCES Users(userID)
) COLLATE='utf8_polish_ci'
;