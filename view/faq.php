<?php
  session_start();
  if(isset($_SESSION['logged_in'])){
    $user = $_SESSION['user'];
  }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Progessional Sage | FAQ</title>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>
    <div>

        <fieldset>
            <legend align='center'>
                <h1>Support</h1>
            </legend>
            <table cellspacing="0" align="center">

                <td>
                    <h3>Support Options</h3>
                    <ul>
                        <li>
                            <h4>Report an Issue</h4>
                            <p>If you encounter any issues while using our educational website, please report them to our support team. We will assist you in resolving the problem.</p>
                        </li>
                        <li>
                            <h4>Contact Support</h4>
                            <p>For any questions, concerns, or assistance, you can reach out to our support team via email, phone, or our contact form. We are here to help you.</p>
                        </li>
                        <li>
                            <h4>Feedback and Suggestions</h4>
                            <p>We value your feedback and suggestions to improve our educational website. Feel free to share your thoughts and ideas with us. Your input is highly appreciated.</p>
                        </li>
                    </ul>

                    <h3>Technical Requirements and Compatibility</h3>
                    <p>Find information about the technical requirements and compatibility for our educational website. Make sure your system meets the necessary specifications for optimal usage.</p>

                    <h3>Account and Login Support</h3>
                    <p>If you need assistance with your account or have any login-related issues, our support team is available to provide guidance and help you resolve any problems.</p>

                    <h3>Knowledge Base or Documentation</h3>
                    <p>Access our knowledge base or documentation to find answers to commonly asked questions and explore helpful resources. You might find solutions to your queries here.</p>

                    <h3>Contact Information</h3>
                    <p>Find our contact information for further assistance or to get in touch with our support team. Reach out to us through email, phone, or visit our office during working hours.</p>

                    <h3>Troubleshooting Guides</h3>
                    <p>Explore our troubleshooting guides to help you troubleshoot common issues you may encounter while using our educational website. These guides provide step-by-step instructions.</p>

                    <h3>Payment Support</h3>
                    <p>If you have any inquiries or need support regarding payments or billing for our courses or services, please contact our dedicated payment support team. We will assist you with your payment-related concerns.</p>


                </td>
            </table>
        </fieldset>
        <fieldset>
            <legend align="center">
                <h3>Questions and Answers</h3>
            </legend>
            <table cellspacing="0" align="center">
                <td>
                    <div>
                        <h4>Question 1: How do I enroll in a course?</h4>
                        <p>Answer: To enroll in a course, navigate to the course page and click on the &quot;Enroll&quot; button. Follow the instructions provided to complete the enrollment process.</p>
                    </div>

                    <div>
                        <h4>Question 2: Can I access the course materials after completing the course?</h4>
                        <p>Answer: Yes, once you complete a course, you will have continued access to the course materials. You can revisit the course content and resources as needed.</p>
                    </div>

                    <div>
                        <h4>Question 3: How can I contact the course instructor?</h4>
                        <p>Answer: You can contact the course instructor through the course platform&#39;s messaging system. Look for the &quot;Contact Instructor&quot; option within the course interface.</p>
                    </div>
                </td>
            </table>
        </fieldset>
    </div>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>