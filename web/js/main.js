
lazyload();

/*
var shuffleCupPlayers = function(min, max) {
    var players = [];
    var shuffled = {};

    var len = max - min;
    var player;
    var index = max;

    for (var i = 0; i <= len; i++) {
        players.push(min);
        min++;
    }
    console.log(players);

    while (players.length) {
        min = Math.ceil(0);
        max = Math.floor(players.length);
        player = Math.floor(Math.random() * (max - min)) + min;
        shuffled[players.slice(player, player + 1)[0]] = index + 1;
        players = players.slice(0, player).concat(players.slice(player + 1));
        index++;
    }

    return shuffled;
}

console.log(shuffleCupPlayers(353, 384));

353:395
354:407
355:391
356:409
357:415
358:392
359:406
360:410
361:387
362:402
363:397
364:390
365:388
366:405
367:398
368:404
369:394
370:396
371:413
372:386
373:408
374:411
375:393
376:389
377:416
378:412
379:414
380:385
381:400
382:401
383:399
384:403


Noctis Lucis Caelum
Ignis Scientia
Gladiolus Amicitia
Prompto Argentum*/