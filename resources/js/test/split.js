let ss = require('sentence-splitter');

let sentences = ss.split(`Okay, so you got financial aid, Mr.  Juth is just... not enough of it to pay for you college tuition. No need to panic. You always have options. And in some cases, one of those options might be to craft a well-written financial aid appeal letter. We're going to tell you how to write one and show you a sample that you can customize. When You Should Appeal`);

sentences.forEach((s) => {

    if(s.type == 'Sentence') {
        console.log(s.raw);
    }
});
//console.log(JSON.stringify(sentences, null, 4));
