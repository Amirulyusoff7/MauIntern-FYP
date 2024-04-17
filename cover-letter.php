<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/indexstyle.css">
</head>
<title>Career Tips</title>
    <style>
    .parent {
    display: grid;
    grid-template-columns: 1fr 1.2fr 1fr;
    grid-template-rows: 0.5fr 6fr 1fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    }

    .title { 
        grid-area: 1 / 2 / 2 / 3; 
    }
    .letter { 
        grid-area: 2 / 2 / 3 / 3; 
        background-color: #F2F2F2;
        padding: 10px;
    }
    </style>

<body>
    <?php
    // require_once "./navbar/header.php";
    require_once "./navbar/sidebar.php";
    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




</head>
<body>


    <div class="parent">
        <div class="title"> 
            <h1>Cover Letter Template </h1><button onclick="downloadAsPDF()">Download as PDF</button>
        </div>
        <div class="letter"> 
            <div id="cover-letter">
                    <h2>[Your Name]</h2>
                    <p>[Your Address]<br>
                    [City, State, ZIP Code]<br>
                    [Your Email Address]<br>
                    [Your Phone Number]</p>

                    <p>[Date]</p>

                    <h2>[Recipient's Name]</h2>
                    <p>[Recipient's Job Title]<br>
                    [Company/Organization Name]<br>
                    [Company/Organization Address]<br>
                    [City, State, ZIP Code]</p>

                    <p>Dear [Recipient's Name],</p>

                    <p>I am writing to express my interest in the [Internship Position] at 
                        [Company/Organization Name], as advertised on [Source of Job Posting]. 
                        With my strong academic background and passion for [relevant field or industry], 
                        I am eager to contribute to your team and gain valuable experience in a professional setting.</p>

                    <p>I am currently a [Year/Major] student at [University/College Name], pursuing a degree in [Relevant Field]. 
                        Through my coursework and extracurricular activities, I have developed a solid foundation in [relevant skills or knowledge], 
                        including [specific skills or knowledge related to the internship]. I am particularly interested in [highlight an aspect of the 
                        internship or company that aligns with your interests or skills].</p>
                    
                    <p>During my studies, I have demonstrated my ability to [mention relevant achievements, projects, 
                        or experiences that showcase your skills or knowledge]. For instance, [provide a specific example of a project, 
                        research, or academic achievement]. These experiences have enhanced my analytical thinking, problem-solving abilities, 
                        and attention to detail.</p>

                    <p>In addition to my academic pursuits, I have also been actively involved in [mention relevant extracurricular activities, 
                        clubs, or organizations]. These experiences have helped me develop strong communication and teamwork skills, as well as a 
                        proactive and adaptable approach to work. I am confident that these qualities will allow me to contribute effectively to your 
                        team and thrive in a dynamic work environment.</p>

                    <p>I am particularly drawn to [Company/Organization Name] due to its impressive track record in [mention a notable achievement or aspect 
                        of the company/organization]. I am eager to contribute my skills and knowledge to support your mission and contribute to your ongoing success.</p>

                    <p>I believe that an internship at [Company/Organization Name] would provide an ideal opportunity for me to further develop my skills and gain practical 
                        experience in [relevant field]. I am confident that my dedication, enthusiasm, and ability to quickly learn new concepts will make me a valuable asset to your team.</p>

                    <p>Thank you for considering my application. I have attached my resume for your review, and I would welcome the opportunity to discuss how my qualifications align with 
                        the [Internship Position]. I look forward to the possibility of contributing to [Company/Organization Name]'s continued success.</p>

                    <p>Thank you for your time and consideration.</p>

                    <p>Sincerely,<br>
                    [Your Full Name]</p>
                </div>
                
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function downloadAsPDF() {
            const element = document.getElementById('cover-letter');
            html2pdf()
                .set({ margin: 0.5, filename: 'cover_letter.pdf', image: { type: 'jpeg', quality: 0.98 }, html2canvas: { dpi: 192, letterRendering: true }, jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' } })
                .from(element)
                .save();
        }
    </script>
    

</body>
</html>
