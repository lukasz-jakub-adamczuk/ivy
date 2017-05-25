var casper = require('casper').create({
    verbose: false,
    logLevel: 'debug'
});
 
casper.start();
 
casper.setHttpAuth('lukasz', 'tekken3');

var json = require('../../ivy/app/tmp/urls-to-convert-texts.json');
// var json = require('../../ivy/app/tmp/stories-to-convert.json');
// require('utils').dump(json);
// casper.echo(json);
// json = ['http://localhost/~ash/ivy/pub/article/12'];
// json = ['http://localhost/~ash/ivy/pub/story/59'];

casper.each(json, function(self, link) {
    self.thenOpen(link, function() {
    	this.echo(link);
        // if (this.exists('#form-verified')) {
        //     this.click('#form-verified');
        // }

    	
        if (this.exists('.bg-dark .color')) {	        
	        this.click('.bg-dark .color');

            this.echo('button found and clicked...', 'INFO');
	    } else {
	        this.echo('button not found', 'ERROR');
	    }

	    casper.wait(2000, function() {
            this.echo('had to wait 2sec!');
        });
    });
});


casper.run(function() {
    this.exit();
});
