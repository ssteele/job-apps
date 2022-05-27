## Job Apps

*A standalone application to help you stay organized while seeking employment*

### Setup
Very basic coding skill is required: PHP, JSON, LaTeX (optional). All you really need to know is how to set up a server to run PHP (there are many easy ways to do this) and how to edit PHP and JSON files using the correct syntax. You'll want to set up a server on your local machine (MAMP, Node, nginx) or publically (hopefully behind basic auth) and serve from project root. No database is necessary.

    git clone https://github.com/ssteele/job-apps.git
    cd job-apps
    composer install

Navigate to the `src/app` folder and copy `config-example.php` to `config.php`. Edit the new file:

    const APP_URL = 'http://YOUR-URL';                              // supply the URL where you are hosting your site
    const ENVIRONMENT = 'production';                               // if 'development', shows error reporting for debuggery
    const AUTO_GENERATE_LATEX_DOCUMENTS = true;                     // (see 'Document generation' below)
    const AUTO_GENERATE_PHP_INTERVIEWS = true;                      // (see 'Document generation' below)
    const AUTO_CURL_HTML_POSTINGS = true;                           // (see 'Document generation' below)

### Save Links, Job Lists, and Companies

Once served, fire up the site (http://YOUR-URL). Then start populating the app with useful links. These could include your online resume, several job lists, companies you're tracking, or anything else you want to keep in a centralized place with the job applications we'll be making later.

*src/jobs/applications/meta.php*

    $links = [
        'Resume'         => 'http://steve-steele.com/cv/',
        'Interview Aide' => 'src/app/interview-aide/',              // this links to the Interview Aide (see details below)
    ];

    $lists = [                                                      // below is a link to Laravel job postings on Indeed that don't have a bunch of unrelated technologies also listed
        'Indeed: Laravel' => 'http://www.indeed.com/jobs?q=%22PHP%22+Laravel+-Java+-.Net+-C+-C%2B%2B+-C%23+-designer&l=Austin%2C+TX&sort=date',
    ];

    $companies = [                                                  // google jobs
        'Google' => 'https://www.google.com/about/careers/search#t=sq&q=j&jl=Kirkland%2CWA%26jl%3DSeattle%2CWA&jc=SOFTWARE_ENGINEERING',
    ];

### Find and Track Jobs
Once you have found a posting that interests you, add it to the app. Job applications are fed into the application using basic PHP arrays:

*src/jobs/applications/applications.php*

    // basic template - duplicate me when you find new job postings
    $jobs[] = Job::create([
        'status'         => 'potential',
        'searchDate'     => '05.15.2015',
        'company'        => 'W2O Group',
        'title'          => 'Junior DevOps Engineer',
        'publicPosting'  => 'http://www.w2ogroup.com/careers/devops-engineer-onre0fwc/#sthash.s2gz1WrS.dpbs',
    ]);

    // ...lots of options
    $jobs[] = Job::create([
        'status'         => 'applied',                              // options: dream, potential, applied, interviewing, declined, abandoned, rejected
        'searchDate'     => '05.15.2015',                           // when you found the posting
        'appDate'        => '05.16.2015',                           // when you actually applied for the job
        'searchLink'     => 'Indeed: Laravel',                      // job list used to find the job
        'company'        => 'W2O Group',                            // company name
        'title'          => 'DevOps Engineer',                      // job title
        'location'       => 'Austin',                               // job location
        'localPosting'   => true,                                   // keep track of the original job posting
        'publicPosting'  => 'https://www.linkedin.com/jobs/view/1/',// link to job posting
        'resume'         => true,                                   // keep track of the resume you sent
        'letter'         => true,                                   // keep track of the cover letter you applied with
        'headhunter'     => false,                                  // track the name of the recruiter
        'network'        => false,                                  // track the name of the person recommended the job
        'interviews'     => [                                       // interviews array
            '06-01-2015' => 'recruiter',                            // add interview dates and types as you have them
            '06-06-2015' => 'code',                                 // keep notes on questions, answers, general happenings using Interview Pages (see details below)
            '06-18-2015' => 'phone',                                // wow, you are killing it with these interviews - interview status defaults to 'done'
            '06-25-2015' => ['face' => 'prep'],                     // ...but you can supply the status, options include: `hold`, `prep`, `wait`, `done`, and `kill`
            '06-30-2015' => ['contract', 'hold'],                   // ...let's just put a placeholder on the offer - feeling good about this one
        ],
    ]);

### Document Generation

In `src/app/config.php`, there are several options you can toggle on or off:

    const AUTO_GENERATE_LATEX_DOCUMENTS = true;                     // if true, the application will generate resumes and cover letters using LaTeX
    const AUTO_GENERATE_PHP_INTERVIEWS = true;                      // if true, the application will generate interview php files
    const AUTO_CURL_HTML_POSTINGS = true;                           // if true, the application will fetch job posting markup and save it locally

#### Auto-Generation (easy)

Setting the above values to true turns on automatic document generation. This allows you to generate assets at the click of the mouse. You can generate a resume and cover letter, as well as save a local copy of of the job posting for applications with 'potential' status by setting the appropriate `Job` object propery (see 'Find and Track Jobs' above) and clicking the appropriate icon. Once you have applied and you've updated the application to 'applied' status, you can add interviews to the `Job`, click the 'spinny' icon, and the application will copy a PHP script from template that you can customize for that interview in `src/jobs/interviews/`.

#### Manual Generation (not as easy)

If you have `AUTO_GENERATE_LATEX_DOCUMENTS`, `AUTO_GENERATE_PHP_INTERVIEWS`, and `AUTO_CURL_HTML_POSTINGS` set to 'false', you'll have to manually create assets and copy them to the correct place in the application if you want to track them. A couple of mock applications have been populated into the app to give you a sense of where to put things. The app will alert you what to name files with a click the appropriate icon/text. The basic workflow is to copy the filename text from the alert box, navigate to the appropriate folder in the jobs directory (postings, cover-letters, or resumes), and save a new file named from the copied filename. Note: new job entries must have a status of 'dream' or 'potential' when following the examples below. Otherwise the app assumes you don't want to save an archive of the posting, or that you do not want to track a resume or cover letter.

Click on the lefthand date of a new entry to save a local copy of the job posting (must copy the original job posting page's source into the new file). Save cover letters and resumes for potential applications with a mouse click over the envelope and page icon outlines to the right. If your cover letter was, say, an email instead of a PDF, change the extension of the new file to 'txt' instead of 'pdf.' Later, we'll also save interviews by adding an entry to the interviews array (see code above) and clicking the spinning arrow: See Interview Pages section below for more.

### Easily Create Custom Resumes and Cover Letters (optional)

For auto-generated documents, you'll need to set LaTeX up on your machine. A basic layout and bash scripts are included. There is also a large selection of layout templates online available for download. I like this approach because customizing a resume or cover letter for a job and authoring out PDFs is a breeze once it's set up... just customize a tex file for a specific job and run the script. Word of warning: LaTeX can be really burdensome if you want to tweak something on your layout.

Here's how I installed it:

    brew install mactex --cask

You may need to update the paths to your LaTeX library in a few files:

    src/jobs/cover-letters/latex/generate-auto.bash
    src/jobs/resumes/latex/generate-auto.bash

You'll also want to update file names from 'steve-steele' to your own name as well as any references therein (eg: generation scripts - search for `steve-steele`).

For manually generated documents, you will want to click the resume or cover letter icon at right to copy the formatted filename the application expects. Save your document with that filename inside the `src/jobs/resumes/` folder.

### Save a Local Copy of the Original Job Posting

Click the search date on the left of a 'Potential' job application with auto-generation enabled to have the server fetch the contents of the public posting you have set in the `Job` object. To save a copy manually, get the job posting be viewing the source of the URL, and save that to the proper filename (retrieved by clicking on the date) within the `src/jobs/postings` folder.

### Interview Pages

When you've secured an interview, add it to the interviews array (inside the corresponding job array) in `src/jobs/applications/applications.php`. Create the `Job` if necessary using the example provided in the code snippet found in the 'Find and Track Jobs' section. You'll want to include the interview date and type. Then hit up the app and click the spinning arrow.

For auto-generated interviews, a php file will be created for you in `src/jobs/interviews/` that you can edit for the interview. The new file will be named using the interview date, job title, and company.

To manually generate the interview, copy the new filename to the clipboard [Ctrl-c]. Navigate to `src/jobs/interviews/` directory and create a new file from template.php: `cp template.php [Ctrl-v]` (pasting from the clipboard into the terminal). If you want to stay clear of terminal, you can simply duplicate template.php and rename it using the copied filepath using finder or whatever. Open the new file (here using '04-21-2015_senior_devops_engineer_w2o_group.php' as the new file) and fill in some job specifics:

*src/jobs/interviews/04-21-2015_senior_devops_engineer_w2o_group.php*

    $type = 'phone';                                                // interview type: recruiter, code, phone, face, contract
    $date = 'February 1, 2015';                                     // interview date
    $time = '9:00am';                                               // interview time

    // Company details
    $company = '';                                                  // company name
    $jobTitle = '';                                                 // position applying to
    $interviewerName = '';                                          // who will be interviewing you
    $interviewerTitle = '';                                         // ...that person's title

    // About the company                                            // section outlining your research about the company
    // Why this job                                                 // reasons why you want to work at this company
    // Prepared questions                                           // questions for them from you
    // Interview aide                                               // can copy a recorded interview log into this section (see Interview Aide section below)
    // Notes                                                        // random notes, how you felt about the interview, the people, how well you did, anything really
    // Email communication                                          // i usually copy important email communications here surrounding the meeting

Now when you go back to the app, that spinning arrow should be a clickable interview icon. Click it to view the interview page you just made.

### Interview Aide

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

    $aboutMe = [
        'title' => 'Get to know you...',                            // aboutMe section title
    ];

    $aboutMe[] = new Question([                                     // ...in aboutMe section
        'question' => 'Tell me about yourself',                     // question
        'answers'  => ['about-me', ],                               // single JSON answer
    ]);

    $aboutMe[] = new Question([
        'question' => 'What motivates you?',
        'answers'  => ['about-me', 'career-goals', ],               // about-me covers this, and i can continue with my career-goals if i want
    ]);

    $aboutMe[] = new Question([
        'question' => 'How do you define success?',
        'answers'  => ['agile-methodology', 'career-goals', ],      // composed using multiple JSON answers for easy app maintenance (as above)
    ]);

Notice the re-use of specific answers for multiple questions. During the interview, if I'm faced with that question about motivation, I will click on the 'about-me' and 'career-goals' questions as I'm answering to mark them as answered. If the interviewer goes on to the success question, the 'career-goals' question is already grayed out, so I'll just cover my 'agile-methodology' talking points and avoid repeating myself. The app will be easier to maintain if you divide your JSON answers up into smaller nuggets and compose them together using the answers array.

You can record your interviews by clicking on the top-most 'Start Recording' button. The act of clicking on answers as shown above will create an interview log that you can save back to the interview page. Copy and paste the code by clicking 'Copy to clipboard' after you're done with the interview and have stopped the recording. This snippet can be saved directly to the interview file (see Interview Pages section above).

*That's about it. Good luck and happy hunting!*