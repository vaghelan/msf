<?php

class Email_model extends CI_Model {

  function send_email($to, $subject, $message)
  {
  
   $this->email->from('info@7thgoswami.com', '7thGoswami');
   $this->email->to('vaghelan@gmail.com');
   //$this->email->cc('another@another-example.com');
   //$this->email->bcc('them@their-example.com');

   $this->email->subject('Email Test');
   $this->email->message('Testing the email class.');

   if (!$this->email->send())
   {
     echo "could not send email";
   }
   else
     echo "Send email successful";
   //echo $this->email->print_debugger();
  
  }
  
  
  function send_signup_email($to, $name, $username, $pwd)
  {
   $this->email_init();
   
   $this->email->from('info@7thgoswami.com', 'Seventh Goswami');
   $this->email->to($to);
   $this->email->subject('Welcome to Festival of 1,008 Book Distributors');
   // $msg = 'Welcome ' . $name . ' ' . 'to 7thGoswami.com.';
   // $msg = $msg . 'Your username is ' . $username . '. Your password is ' . $pwd;
   
   $msg = "<html> <head>
      
<style>
h4 {
display: block;
padding: 10px;
margin: 10px;
background: #CDEB8B;
border: 1px solid #73880A;
font-size: 16px;
}
p {margin: 10px 0px 10px 0px;}
</style>
   
   </head> <body> 
<img src=\"http://7thgoswami.com/images/header.jpg\"/></br>


<p>Welcome " . $name. "!" . "</p>" .

"<p>Thank you for subscribing to the Bhaktivinoda Thakura International
Festival of 1,008 book distributors.</p>

<p>Everyone on our team cheered when they saw that you had joined us.</p>

<p>We have a website <a href=\"http://www.7thgoswami.com/account?login\">www.7thGoswami.com/account?login</a> that can serve as kit for you and your friends to get started.</p>

<h4>
Your Username: " . $username .
"<br>Your Password: " . $pwd . 

"<p>Please change your password using Profile page after you login.</p>" .
"<p>In case of any technical difficulties send email to admin@7thgoswami.com </p>" .
"</h4><p>We look forward to assisting you and we will send you updates.</p>


<h3>Our goal:</h3>

<p>To bring together at least 1,008 people who each distribute at least
one transcendental BBT book.</p>

<p>The festival officially starts on May 27th and ends on June 30th, the
disappearance day of the saint Srila Bhaktivinoda Thakura.</p>

<p>To be counted as one of the 1,008 distributors, you must:
</p>
<b>a) distribute at least one BBT book between May 27th and June 30th.</b><BR>
<b>b) Report your progress to www.7thGoswami.com.</b><BR>

<p>There will be other progressive levels of achievement to aspire for,
if you wish. We’ll give you more details soon.</p>

<p>There are many ways to help people in this world. But, Sri Caitanya
Mahaprabhu, the founder of the sankirtana movement five hundred year
ago, tells us that the best way is to give people spiritual knowledge.</p>

<p>His Divine Grace A.C. Bhaktivedanta Swami Prabhupada, Founder-Acarya
of ISKCON, brought us the treasure of transcendental knowledge in his
extraordinary books.</p>

<p>Those who read and distribute these books benefit themselves and others.
</p>
<p>Those who give mercy, get mercy.
</p>
<p>On behalf of Team ISV, I thank you from the bottom of my heart for
joining us for this exciting event.
</p>
<p>We will be in touch with more information and exciting news soon.
</p>
With gratitude,<BR>
Vaisesika Dasa
<BR>

<p>P.S.  A story (as told by Sri Caitanya Mahaprabhu to Sanatana Goswami):
</p>
<p>Once a very poor man, suffering due to poverty, met an all-knowing astrologer. The astrologer read the man’s chart and told him, “You are not actually a poor man. Your father, who was very rich, left you an abundant inheritance when he died. Now all you have to do is dig it up.”
The astrologer next told the poor man exactly where the treasure was buried and gave him specific directions about the best way to dig for it.
Lord Caitanya said that when a poor man finds out that he is actually rich, his entire perspective in life changes instantly and he becomes happy.
</p>
<p>Similarly, when those suffering in this world receive transcendental knowledge, they become happily enriched with spiritual knowledge.
The Vedas not only direct us to our highest prospect in life, but they also show us the means to attain it.
</p>
<p>These books are not ordinary. Reading even one word or one line within them can to awaken a person to his or her eternal, blissful relationship with Krsna, the Supreme Person.
</p>
<p>Bhaktivinoda Thakura is a great Acarya (teacher of transcendental knowledge) who, near the end of the 18th century, revitalized the sankirtana movement of Lord Caitanya Mahaprabhu and also sent books of transcendental knowledge outside India to benefit people of the world. Other great Acaryas, including Srila Bhaktisiddhanta Saraswati and Srila A.C. Bhaktivedanta Swami did the same. And now we have an opportunity to assist them.</p>
</body>
</html>
";
   
   $this->email->message($msg);

   if (!$this->email->send())
   {
     log_message('debug', "Could not send signup email to  " . $to . " " . $name . " ". $username);
     log_message('debug', $this->email->print_debugger());
     return 0;
   }  
   else
   {
     log_message('debug', "Successfully Sent signup email to  " . $to . " " . $name . " ". $username);
     return 1;
   }  

   
  
  }
  function email_init()
  {
    $config['protocol'] = 'sendmail';
    //$config['mailpath'] = '/usr/sbin/sendmail';
    //$config['charset'] = 'iso-8859-1';
    //$config['wordwrap'] = TRUE;
    $config['smtp_host'] = 'mail.7thgoswami.com';
    $config['smtp_user'] = 'info@7thgoswami.com';
    $config['smtp_pass'] = 'ADMIN1008$';
    $config['mailtype'] = 'html';  
  
    $this->email->initialize($config);
  
  }  
  function send_invite_email($to, $name, $invite_link, $message)
  {
  
   $this->email_init();
  
   $this->email->from('info@7thgoswami.com', $name);
   $this->email->to($to);
   $this->email->subject('Please register on 7thGoswami.com');
   
   log_message('debug', "invite : " . $to . " " . $name . " " . $invite_link);
   
   
   $msg1 = "<html><header> <style>
      a {
display: block;
padding: 10px;
margin: 10px;
background: #CDEB8B;
border: 1px solid #73880A;
font-size: 16px;
}</style></header>
<div>
<img src=\"http://7thgoswami.com/images/header.jpg\"/></br>
<p> <em style=\"color: #00202e; font-size=110%\">" . $message . "</em></p> With gratitude, ".$name . 
"<p>
<BR>
We bring you warm greetings from ISKCON of Silicon Valley (ISV) where our mission is to serve all living beings by widely distributing the Holy Names
of Krishna.
</p>
<p>
<BR>
We invite you to join us by registering at ".$invite_link." for a fun and blissful drive that will bring good fortune to everyone that it touches.
</p>
<p>
<BR>
Benefits for you:
</p>
<BR>
<ul>
	<li>
	Feel great about yourself
	</li>
	<li>
	Have fun along with your friends and relatives
	</li>
	<li>
	Link up with positive-minded, dynamic devotees around the world
	</li>
	<li>
	Make new friends
	</li>
	<li>
	Serve the great Acaryas
	</li>
	<li>
	Alter the destiny of the world
	</li>
	<li>
	Get recognized and promoted by Lord Caitanya
	</li>
	<li>
	Be a part of a winning team
	</li>
</ul>

<p>
<BR>
Over a three-week period starting this June, 2011, we will assemble a team of at least 1,008 members to actively distribute transcendental books to
benefit people of the world. We will offer the results of this event to the great Acarya (world teacher of spiritual knowledge) Bhaktivinoda Thakura on
his disappearance day, Thursday, June 30th. Around the same time last year, with much less time to plan, 550 people joined this campaign. We are
starting earlier and in a much better organized way this year.
</p>
<p>
<BR>
Our principle for success is to get a lot of people, each one doing a little and while doing making it fun and easy. And to make it even more exciting,
we ask everyone to invite their friends, family members, and colleagues to join them, asking everyone to do a small bit.
</p>
<p>
<BR>
This website ".$invite_link." serves as kit to help you and your friends get started. It contains:
</p>
<BR>
<ul>
	<li>
	Information on where &amp; how to get books, report scores, and so on
	</li>
	<li>
	Presentation on how to sell a book
	</li>
	<li>
	List of materials you’ll need and where to get them
	</li>
	<li>
	Language cards (so that you can sell a book in any language)
	</li>
	<li>
	Wrist band (Shows your participation and attracts others to join you)
	</li>
	<li>
	Contact info for a mentor who will guide you
	</li>
	<li>
	Links to information websites
	</li>
	<li>
	Links to YouTube videos where you can see examples of devotees distributing books
	</li>
</ul>

<p>
<BR>
By joining this festival you will feel inner happiness because you will be contributing directly to the spiritual welfare of people of the world.
</p>

<p>
<BR>
In the Bhagavad Gita, Sri Krsna says that the person who spreads spiritual knowledge does the highest welfare work and is dearest to Him. And there has
never been a better time to please Krsna in this most exalted way.
</p>

<p>
<BR>
People of the world are unsettled as they see their fellow citizens rising up against their leaders, while the leaders are blindly employing stopgap
measures or violence to stem the tide. The Middle East is broiling. Japan, New Zealand, Chile, and Haiti are all facing epic natural and man-made
environmental crises. Even affluent nations are going through times of economic uncertainty and working people everywhere are juggling finances just to
stay afloat. And these are a few samples of what is happening throughout the world.
</p>
<p>
<BR>
Fading is the promise of happiness through material acquisition or advanced scientific research. People are now hungry for a spiritual practice that
will give them direct experience of the supreme transcendence and tangible inner happiness that they can share with others.
</p>
<p>
<BR>
The ancient Vedas — now available in beautifully presented books – show this path. We have stockpiled these books and are ready to distribute them to
the masses.
</p>
<p>
<BR>
<b>You can make a difference!</b>
</p>
<p>
<BR>
Join our team of world-wide distributors for this unprecedented mission that will distribute thousands of transcendental books, providing effective
spiritual solutions to sincere people of the world.
</p>
<p>
<BR>
Following Sri Caitanya Mahaprabhu and displaying his own compassion for the people of the world, Bhaktivinoda Thakura sent transcendental books to
people outside India. As the first Acharya in our line to do so, he sent the book entitled, <b><i>Caitanya Mahaprabhu, His Life and Precepts,</i></b>
to scholars and literary luminaries of the time, thereby planted seeds for the sankirtan movement (the movement for cooperatively spreading spiritual
knowledge) in the West.
</p>
<p>
<BR>
Bhaktivinoda entrusted Sri Caitanya Mahaprabhu’s sankirtan movement to his son, Srila Bhaktisiddhanta Saraswati, who in turn passed it on to his
disciples, among whom was Srila A.C. Bhaktivedanta Swami Prabhupada, who personally brought Lord Caitanya’s mission to the United States in 1965.
Following the order of his spiritual master and the example of Srila Bhaktivinoda, Srila Prabhupada brought trunk loads of his transcendental books on
Krishna consciousness for distribution. He also tirelessly traveled throughout the world, speaking, writing, and training his own disciples in the
science of Krsna consciousness as taught by Sri Caitanya Mahaprabhu.
</p>
<p>
<BR>
Bhaktivinoda Thakura says . . .
</p>
<p>
<BR>
<i>
jive doya, krishna-nam-sarva-dharma-sar
<br/>
The showing of compassion to all fallen souls by loudly chanting the holy name of Krishna is the essence of all forms of religion.
</i>
</p>
<p>
<BR>
Passed down through this chain of teachers and students (disciplic succession), this treasure of transcendental knowledge has now been laid at our
doorsteps by Lord Caitanya and his followers. And they are inviting us to distribute this knowledge. His Divine Grace A.C. Bhaktivedanta Swami
Prabhupada has put all of Lord Caitanya’s teachings into beautifully illustrated and perfectly bound books that are waiting to be distributed to
millions of people all over the world.
</p>
<p>
<BR>
Help pass these books on!
</p>
<p>
“
<i>
The more such literatures are read and distributed, the more auspicity will be there in the world.” (Srila A.C. Bhaktivedanta Swami Prabhupada;
quote from letter to Lilavati; 26 March, 1972)
</i>
</p>
<p>
<BR>
Srila Prabhupada not only fulfilled Bhaktivinoda Thakura’s prediction that “a great General would soon appear to spread Lord Caitanya’s teaching’s all
over the world,” but also ensured that it would continue through the generations by passing the torch to his disciples and followers, training them and
empowering them to “do as he had done.”
</p>
<p>
<BR>
<b>
<br/>

Catch these divine orders from the disciplic succession and in honor of Bhaktivinoda Thakura.
</b>
</p>
<BR>
<p>
<b>
Reap the mercy of Bhaktivinoda Thakura!
<BR>
<br/>
It’s fun and easy.
</b>
</p>
<p>
<BR>
We look forward to assist you.
</p>
<p>
<BR>
With Gratitude,
</p>
<BR>
<p>" . 

$name .

"</p>
</div> </html>";   
   
   $this->email->message($msg1);

   if (!$this->email->send())
   {
     log_message('debug', "Could not send invite email to  " . $to);
     return 0;
   }  
   else
   {
     log_message('debug', "Successfully Sent invite email to  " . $to);
     return 1;
   }  

   //log_message('debug', $this->email->print_debugger());
  
  }
  
  function send_story_post_email($name, $subject, $story)
  {
  
   $this->email->from('info@7thgoswami.com', $name);
   $this->email->to('post@7thgoswami.com');
   $this->email->subject($subject);
   $msg = "Author: <author>" . $name .  "</author> Location: San Jose, CA, USA \n";
   $msg = $msg . $story;
   
   
   $this->email->message($msg);

   if (!$this->email->send())
   {
     log_message('debug', "could not send story email to post@7thgoswami.com from " . $name);
     return 0;
    } 
   else
   {
     log_message('debug', "Successfully Sent story email to post@7thgoswami.com from " . $name);
     return 1;
    } 
  
  
  }
  



}