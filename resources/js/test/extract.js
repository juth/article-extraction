
const read = require('node-readability');
const ss   = require('sentence-splitter');

const url  = 'https://www.nitrocollege.com/blog/how-to-write-a-successful-financial-aid-appeal-letter';

read(url, function(err, article, meta) {
  
    console.log(article.title);
  
    let sentences = ss.split(article.textBody);

        console.log('<div>');
        sentences.forEach((s) => {
            
            if(s.type == 'Sentence')
                console.log('<span>' + s.raw + '</span>');
            
            else if(s.type == 'WhiteSpace' && s.raw == "\n\n") {
                console.log("</div>\n<div>");
            }
        });
        console.log('</div>');

    // Close article to clean up jsdom and prevent leaks
    article.close();
});
