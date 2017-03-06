##Job Apps

*A standalone application to help you stay organized while seeking employment*

###Setup
Very basic coding skill is required: PHP, JSON, LaTeX (optional). You'll want to set up a server on your local machine (MAMP, Node, nginx) or publically (hopefully behind basic auth) and serve from project root. No database is necessary.

    git clone https://github.com/ssteele/job-apps.git
    cd job-apps
    composer install

###Save Links, Job Lists, and Companies

Once served, fire up the site (http://YOUR-URL). Then start populating the app with useful links. These could include your online resume, several job lists, companies you're tracking, or anything else you want to keep in a centralized place with the job applications we'll be making later.

*src/jobs/applications/meta.php*

    $links = [
        'Resume'         => 'http://steve-steele.com/cv/',
        'Interview Aide' => 'src/app/interview-aide/',              // this links to the Interview Aide (see details below)
    ];

    $lists = [                                                      // below is a link to Laravel job postings on Indeed that don't have a bunch of unrelated technologies also listed
        'Indeed (Laravel)' => 'http://www.indeed.com/jobs?q=%22PHP%22+Laravel+-Java+-.Net+-C+-C%2B%2B+-C%23+-designer&l=Austin%2C+TX&sort=date',
    ];

    $companies = [                                                  // google jobs
        'Google' => 'https://www.google.com/about/careers/search#t=sq&q=j&jl=Kirkland%2CWA%26jl%3DSeattle%2CWA&jc=SOFTWARE_ENGINEERING',
    ];

###Find and Track Jobs
Once you have found a posting that interests you, add it to the app. Job applications are fed into the application using basic PHP arrays:

*src/jobs/applications/applications.php*

    // basic template - duplicate me when you find new job postings
    $jobs[] = Job::create([
        'status'         => 'potential',
        'search_date'    => '05.15.2015',
        'title'          => 'Junior DevOps Engineer',
        'company'        => 'W2O Group',
        'public_posting' => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    ]);

    // ...lots of options
    $jobs[] = Job::create([
        'status'         => 'rejected',                             // options: dream, potential, applied, rejected
        'search_date'    => '05.15.2015',                           // when you found the posting
        'app_date'       => '05.16.2015',                           // when you actually applied for the job
        'title'          => 'DevOps Engineer',                      // job title
        'company'        => 'W2O Group',                            // company name
        'local_posting'  => true,                                   // if true, clicking on date in the app alerts you to the file that you should save the job posting markup within
        'public_posting' => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
        'resume'         => true,                                   // keep track of the resume you sent
        'letter'         => true,                                   // keep track of the cover letter you applied with
        'network'        => false,                                  // keep track of who recommended the job
        'headhunter'     => false,                                  // was it a recruiter? auugh
        'interviews'     => [                                       // interviews array
            '06-01-2015' => 'recruiter',                            // ...add interview dates and types as you have them
            '06-06-2015' => 'code',                                 // ...keep notes on questions, answers, general happenings using Interview Pages (see details below)
            '06-18-2015' => 'phone',                                // ...wow, many interviews
            '06-25-2015' => 'face',                                 // ......you are
            '06-30-2015' => 'contract',                             // .........killing it
        ],
    ]);

A couple of mock applications have been populated into the app to give you a sense of where to put things. The app will alert you what to name files with a click the appropriate icon/text. The basic workflow is to copy the filename text from the alert box, navigate to the appropriate folder in the jobs directory (postings, cover-letters, or resumes), and save a new file named from the copied filename. Note: new job entries must have a status of 'dream' or 'potential' when following the examples below. Otherwise the app assumes you don't want to save an archive of the posting, or that you do not want to track a resume or cover letter.

Click on the lefthand date of a new entry to save a local copy of the job posting (must copy the original job posting page's source into the new file). Save cover letters and resumes for potential applications with a mouse click over the envelope and page icon outlines to the right. If your cover letter was, say, an email instead of a PDF, change the extension of the new file to 'txt' instead of 'pdf.' Later, we'll also save interviews by adding an entry to the interviews array (see code above) and clicking the spinning arrow: See Interview Pages section below for more.

###Easily Create Custom Resumes and Cover Letters (optional)

For this you'll need to set LaTeX up on your machine. If you've never heard of LaTeX, you should forget that last sentence and generate PDFs using some online service. Or make DOCs if you must. A basic layout and bash scripts are included if you're game to using LaTeX. There is also a large selection of layout templates online available for download. I like this approach because customizing a resume or cover letter for a job and authoring out PDFs is a breeze once it's set up... just customize a tex file for a specific job and run the script. Word of warning: LaTeX can be really burdensome if you want to tweak something on your layout.

Here's how I installed it:

    brew cask install mactex

You may need to update the paths to your LaTeX library in a few files:

    src/jobs/cover-letters/latex/generate-auto.bash
    src/jobs/resumes/latex/generate-auto.bash

You'll also want to update file names from 'steve-steele' to your own name as well as any references therein.

###Interview Pages

When you've secured an interview, add it to the interviews array (inside the corresponding job array) in `src/jobs/applications/applications.php`. Create it if necessary using the example provided in the code snippet found in the Find and Track Jobs section. You'll want to include the interview date and type. Then hit up the app and click the spinning arrow. Copy the new filename to the clipboard [Ctrl-c]. Navigate to `src/jobs/interviews/` directory and create a new file from template.php: `cp template.php [Ctrl-v]` (pasting from the clipboard into the terminal). If you want to stay clear of terminal, you can simply duplicate template.php and rename it using the copied filepath using finder or whatever. Open the new file (here using '04-21-2015_senior_devops_engineer_w2o_group.php' as the new file) and fill in some job specifics:

*src/jobs/interviews/04-21-2015_senior_devops_engineer_w2o_group.php*

    $type = 'phone';                                                // interview type: recruiter, code, phone, face, contract
    $date = 'February 1, 2015';                                     // interview date
    $time = '9:00am';                                               // interview time

    // Company details
    $company = '';                                                  // company name
    $job_title = '';                                                // position applying to
    $interviewer_name = '';                                         // who will be interviewing you
    $interviewer_title = '';                                        // ...that person's title

    // About the company                                            // section outlining your research about the company
    // Why this job                                                 // reasons why you want to work at this company
    // Prepared questions                                           // questions for them from you
    // Interview aide                                               // can copy a recorded interview log into this section (see Interview Aide section below)
    // Notes                                                        // random notes, how you felt about the interview, the people, how well you did, anything really
    // Email communication                                          // i usually copy important email communications here surrounding the meeting

Now when you go back to the app, that spinning arrow should be a clickable interview icon. Click it to view the interview page you just made.

###Interview Aide

http://YOUR-URL/app/interview-aide/

Outline answers to common interview questions using JSON.

*src/jobs/interview-aide/json/general-question-answer.json*

    {
        "about-me" : {
            "li" : "I have a Masters in Atmospheric Science",
            "ul" : [
                {"li" : "First exposure to programming &amp; computational methods"},
                {"li" : "Realized I have a strong technical prowess; Lot's of interest"},
                {"li" : "Was planning to to pursue a career in numerical modeling; Wife was accepted to UT grad school in architecture and Austin was too good to pass up"},
                {"li" : "Got into web development because it was easily accessible and has creative elements"},
                {"li" : "Initially worked as a contractor on an eclectic mix of projects"},
                {"li" : "Have been working in an agency setting (with agile aspirations) for more than 3 years"}
            ]
        },
        "career-goals" : {
            "li" : "A narration of the history of my career",
            "ul" : [
                {"li" : "While an undergraduate, took many internships to gain real-world experience"},
                {"li" : "One internship lead to my first real job (HARP) where I used my undergraduate education"},
                {"li" : "This job had flexibility, allowed me to travel, important to me at the time"},
                {"li" : "Always knew I would return for my Masters"},
                {"li" : "Followed my undergraduate concentration (fell into Meteorology)"},
                {"li" : "Years of catch-up and intense learning: fell in love with the elegance of the math, but drawn to the daily programming involved"},
                {"li" : "After graduating, contracted myself out as a freelance programmer &amp; web developer (and more travel)"},
                {"li" : "Settled into Austin in 2011 and worked at a couple of small digital shops (PCS and VM Foundry)"},
                {"li" : "Bought out by a larger marketing firm (W2O Group) at beginning of 2013 and have since been working at a larger scale"}
            ]
        },
        "agile-methodology" : {
            "li" : "Blah blah blah..."
        }
    }

Organize your content into topic sections. The example below is a 'Get to know me' section. Here I define questions I might expect to face during an interview, and I use the answers I created previously (above) to address those questions.

*src/jobs/interview-aide/general-question-answer.php*

    $about_me = [
        'title' => 'Get to know you...',                            // about_me section title
    ];

    $about_me[] = new Question([                                    // ...in about_me section
        'question' => 'Tell me about yourself',                     // question
        'answers'  => ['about-me', ],                               // single JSON answer
    ]);

    $about_me[] = new Question([
        'question' => 'What motivates you?',
        'answers'  => ['about-me', 'career-goals', ],               // about-me covers this, and i can continue with my career-goals if i want
    ]);

    $about_me[] = new Question([
        'question' => 'How do you define success?',
        'answers'  => ['agile-methodology', 'career-goals', ],      // composed using multiple JSON answers for easy app maintenance (as above)
    ]);

Notice the re-use of specific answers for multiple questions. During the interview, if I'm faced with that question about motivation, I will click on the 'about-me' and 'career-goals' questions as I'm answering to mark them as answered. If the interviewer goes on to the success question, the 'career-goals' question is already grayed out, so I'll just cover my 'agile-methodology' talking points and avoid repeating myself. The app will be easier to maintain if you divide your JSON answers up into smaller nuggets and compose them together using the answers array.

You can record your interviews by clicking on the top-most 'Start Recording' button. The act of clicking on answers as shown above will create an interview log that you can save back to the interview page. Copy and paste the code by clicking 'Copy to clipboard' after you're done with the interview and have stopped the recording. This snippet can be saved directly to the interview file (see Interview Pages section above).

*That's about it. Good luck and happy hunting!*