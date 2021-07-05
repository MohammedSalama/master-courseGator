INSERT INTO cats(`name`)
VALUES
('Web Apps'),
('Mobile Apps'),
('Artificial Intelligence');

INSERT INTO courses(`name` , `desc` , `img` , `cat_id`)
VALUES
('Front End From Zero To Hero' , 'Web designer: A web designer, you guessed it, designs websites. The job title of web designer is pretty broad, though. A web designer could just be someone who designs the sites in a program like Photoshop or Fireworks and will never touch the code. But in another location, a web designer could do all the design comps in Photoshop and then be responsible for creating all the HTML and CSS (and sometimes even JavaScript) to go along with it.' , '1.png' , 1),
('Mastering Back End' , 'A back-end web developer is responsible for server-side web application logic and integration of the work front-end developers do. Back-end developers are usually write the web services and APIs used by front-end developers and mobile application developers.' , '2.png' , 1),
('Kotlin Mobile App Development' , 'Write better Android apps faster with Kotlin. Kotlin is a modern statically typed programming language used by over 60% of professional Android developers that helps boost productivity, developer satisfaction, and code safety.' , '3.png' , 2),
('Ios Development' , 'iOS Developers code applications for mobile apple products, including iPhones, iPod Touches and iPads. To be a successful iOS developer, you need to be fluent in the coding languages of C, C++, Objective-C or Swift.' , '4.png' , 2),
('Introduction To AI' , 'AWS offers the broadest and deepest set of machine learning services and supporting cloud infrastructure, putting machine learning in the hands of every developer, data scientist and expert practitioner. Named a leader in Gartner' , '5.png' , 3),
('Computer Vision' , 'Computer Vision (CV) is transforming some of today’s most critical and complex challenges, from predictive maintenance to medical imaging. In this report, Forrester uses a range of criteria to evaluate the most significant CV consultancies — including Insight.' , '6.png' , 3);