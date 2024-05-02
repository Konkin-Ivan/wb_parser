# seo-engine-parser

![GitHub commit activity](https://img.shields.io/github/commit-activity/m/Konkin-Ivan/seo-engine-parser?logo=github&style=for-the-badge)
![GitHub last commit](https://img.shields.io/github/last-commit/Konkin-Ivan/seo-engine-parser?logo=github&style=for-the-badge)
![GitHub](https://img.shields.io/github/license/Konkin-Ivan/seo-engine-parser?logo=github&style=for-the-badge)

SEO analysis programs are usually proprietary and have commercial licenses. We will create our own set of open-source tools that will help design and build websites with the proper SEO architecture.

## 1. Site analitics

Project Name: Service for Analyzing the Technical Condition of Websites

Project Goal: Develop a PHP program that, based on the provided website name, will provide information about the technical condition of the site. The program will have a modular structure, allowing for easy expansion of its functionality with new modules.

Key Requirements for the Program:
1. User Interface: Implement a simple interface for entering the website name and displaying the results of the technical condition analysis.
2. Modularity: Create the core of the program that can be easily expanded with modules. Each module will be responsible for a specific aspect of analyzing the technical condition of the site (e.g., loading speed, security, SEO metrics, etc.).
3. Data Collection and Processing: Implement a mechanism to gather necessary information about the website, such as through API requests to third-party services or scanning website pages.
4. Reports: Generate structured reports about the technical condition of the site based on the collected data.
5. Error Handling: Ensure proper error and exception handling, providing clear error messages to the user.
6. Data Security: Ensure the security of data processing and storage, preventing leakage of confidential information.

Technical Details:
- Programming Language: PHP
- Technologies Used: HTML, CSS, JavaScript (for the interface)
- Version Control System: Git (hosted on GitHub)
- Database: Not required
- System Requirements: Web server with PHP support, Internet access for accessing third-party services

Project Management:
- Communication: Communication and discussions will be conducted through GitHub Issues and Pull Requests.
- Timelines: The development of the program will be divided into stages with specific deadlines.
- Testing: Plan to test the program on various types of websites to verify the accuracy and reliability of the results.

Project Acceptance: The program will be considered complete after successfully passing all tests and fully meeting the requirements of the technical specification.

## 2. Contributing guidelines

For developing a modern PHP application, it is important to follow coding standards, such as PSR (PHP Standards Recommendations), which help ensure code consistency and readability. Here are some requirements and recommendations for working with PHP code:

1. Compliance with PSR standards: Follow PSR-1 (Basic Coding Standard) and PSR-2 (Coding Style Guide) for organizing code, indentations, naming classes and methods, using curly braces, etc. PSR-12 refines the style guides.

2. Use type declarations: In PHP 7 and above, it is recommended to use type declarations for function parameters and return values. For example, function process(int $num): string.

3. Provide informative comments and descriptions: The code should be well-documented, including comments for classes, methods, and complex code sections. Commit messages should be informative and describe the essence of the changes.

4. Variable and function names should be clear and descriptive: Avoid using overly short or abbreviated names, instead use meaningful words or phrases. For example, instead of $a or $temp, use $counter or $userList.

5. Avoid magic numbers and strings: Do not hardcode values directly into the code. Define them as constants or variables for better code readability and maintainability.

6. Exception handling: Proper exception handling is important for safe and stable application operation. Use try-catch blocks and throw exceptions where necessary.

7. Use modern practices: Include authentication and authorization, data handling and validation, protection against XSS and SQL injections, use ORM or PDO for database operations, etc.

Following these requirements will help create clean, readable, and efficient code for a modern PHP application.

## 3. Code of conduct

As contributors and maintainers of this project, we pledge to respect all individuals who interact with the project community, regardless of their background, beliefs, gender identity, sexual orientation, race, or other personal characteristics. We strive to create a positive and inclusive environment where everyone feels welcome and valued.

In order to maintain a respectful and collaborative community, we expect all participants to adhere to the following guidelines:

1. Be respectful and considerate towards others. Treat all individuals with kindness and understanding.

2. Avoid offensive, discriminatory, or disrespectful language and behavior. Harassment of any kind will not be tolerated.

3. Listen to and acknowledge the viewpoints of others, even if they differ from your own. Disagreements should be handled constructively and respectfully.

4. Contribute in a positive and helpful manner. Offer constructive feedback, guidance, and support to fellow community members.

5. Be open to learning and growing. Embrace diversity and varying perspectives within the community.

6. Refrain from promoting spam, advertising, or any other unrelated content in the project channels.

7. Violations of the code of conduct will be addressed by project maintainers, and may result in removal from the community if deemed necessary.

By participating in this open source project, you agree to abide by these guidelines and uphold the values of respect, inclusivity, and collaboration within the community. Let's work together to create a welcoming and supportive environment for all project contributors and users.
