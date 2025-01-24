document.addEventListener('DOMContentLoaded', () => {
    const startbtn = document.querySelector('.start-btn');
    const popupinfo = document.querySelector('.popup-info');
    const exitbtn = document.querySelector('.exit-btn');
    const main = document.querySelector('.main');
    const continuebtn = document.querySelector('.continue-btn');
    const quizsection = document.querySelector('.quiz-section');
    const quizbox = document.querySelector('.quiz-box');
    const nextbtn = document.querySelector('.next-btn');
    const optionlist = document.querySelector('.option-list');
    const resultbox = document.querySelector('.result-box');
    const tryagainbtn = document.querySelector('.tryagain-btn');
    const gohomebtn = document.querySelector('.gohome-btn');



    // Updated questions
    const questions = [
        {
            Numb: 1,
            question: "What does HTML stand for?",
            answer: "A. Hypertext Markup Language",
            options: [
                "A. Hypertext Markup Language",
                "B. Hightext Markup Language",
                "C. Hyperlink and Text Markup Language",
                "D. Hypertext Markup Locator"
            ]
        },
        {
            Numb: 2,
            question: "What is the capital of Japan?",
            answer: "C. Tokyo",
            options: [
                "A. Seoul",
                "B. Beijing",
                "C. Tokyo",
                "D. Bangkok"
            ]
        },
        {
            Numb: 3,
            question: "Which gas is most abundant in the Earth's atmosphere?",
            answer: "C. Nitrogen",
            options: [
                "A. Oxygen",
                "B. Carbon Dioxide",
                "C. Nitrogen",
                "D. Hydrogen"
            ]
        },
        {
            Numb: 4,
            question: "Who wrote 'Romeo and Juliet'?",
            answer: "C. William Shakespeare",
            options: [
                "A. Charles Dickens",
                "B. Mark Twain",
                "C. William Shakespeare",
                "D. Jane Austen"
            ]
        },
        {
            Numb: 5,
            question: "What is the chemical symbol for gold?",
            answer: "A. Au",
            options: [
                "A. Au",
                "B. Ag",
                "C. Pb",
                "D. Fe"
            ]
        }
    ];

    startbtn.onclick = () => {
        popupinfo.classList.add('active');
        main.classList.add('active');
    };
    
    exitbtn.onclick = () => {
        popupinfo.classList.remove('active');
        main.classList.remove('active');
    };

    continuebtn.onclick = () => {
        quizsection.classList.add('active');
        popupinfo.classList.remove('active');
        main.classList.remove('active');
        quizbox.classList.add('active');

        showQuestion(0);
        questioncounter(1);
        headerscore();
    };
    tryagainbtn.onclick = () => {
        quizbox.classList.add('active');
        nextbtn.classList.remove('active');

        resultbox.classList.remove('active');


        questioncount = 0;
     questionNumb = 1;
     userscore = 0;
     showQuestion(questioncount);
     questioncounter(questionNumb);
     headerscore();

    };

    gohomebtn.onclick = () => {
        quizsection.classList.remove('active');
        nextbtn.classList.remove('active');

        resultbox.classList.remove('active');


        questioncount = 0;
     questionNumb = 1;
     userscore = 0;
     showQuestion(questioncount);
     questioncounter(questionNumb);
     headerscore();

    };






    let questioncount = 0;
    let questionNumb = 1;
    let userscore = 0;

    nextbtn.onclick = () => {
        if (questioncount < questions.length - 1) {
            questioncount++;
            questionNumb++;
            showQuestion(questioncount);
            questioncounter(questionNumb);
        } else {
            showresultbox();
        }
    };
    
    function showQuestion(index) {
        const questionText = document.querySelector('.question-text');

        if (index < questions.length) {
            questionText.textContent = `${questions[index].Numb}. ${questions[index].question}`;
            let optiontag = '';
            questions[index].options.forEach(option => {
                optiontag += `<div class="option">${option}</div>`;
            });
            optionlist.innerHTML = optiontag;
            const option = document.querySelectorAll('.option');
            for (let i = 0; i < option.length; i++) {
                option[i].setAttribute('onclick', 'optionselected(this)');
            }
        } else {
            console.log("No more questions available.");
        }
    }

    window.optionselected = function(answer) {
        let useranswer = answer.textContent;
        let correctanswer = questions[questioncount].answer;
        let alloption = optionlist.children.length;
        
        if (useranswer === correctanswer) {
            answer.classList.add('correct');
            userscore += 1;
            headerscore();
        } else {
            answer.classList.add('incorrect');
        }
        for (let i = 0; i < alloption; i++) {
            optionlist.children[i].classList.add('disable');
        }
    }

    function questioncounter(index) {
        const questiontotal = document.querySelector('.question-total');
        questiontotal.textContent = `${index} of ${questions.length} questions`;
    }

    function headerscore() {
        const headerscoretext = document.querySelector('.header-score');
        headerscoretext.textContent = `score: ${userscore} / ${questions.length}`;
    }

    function showresultbox() {
        quizbox.classList.remove('active'); 
        resultbox.classList.add('active');
    
        const scoretext = document.querySelector('.score-text');
        scoretext.textContent = `Your score: ${userscore} out of ${questions.length}`;
    
        const circularprogress = document.querySelector('.circular-progress');
        const progressvalue = document.querySelector('.progress-value');
    
        let progressStartValue = -1; // Fixed typo
        let progressEndValue = (userscore / questions.length) * 100; // Calculate percentage
        let speed = 20;
    
        let progress = setInterval(() => {
            progressStartValue++;
            progressvalue.textContent = `${progressStartValue}%`; // Use backticks for interpolation
            circularprogress.style.background = `conic-gradient(#c40094 ${progressStartValue * 3.6}deg, rgba(255, 255, 255, 0) 0deg)`; // Update progress
    
            if (progressStartValue >= progressEndValue) {
                clearInterval(progress);
            }
        }, speed);
    }
    
});
