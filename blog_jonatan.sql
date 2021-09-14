-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 04, 2021 at 06:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_jonatan`
--
CREATE DATABASE IF NOT EXISTS `blog_jonatan` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blog_jonatan`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `fk_author` int(11) NOT NULL,
  `fk_post` int(11) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `created_date`, `fk_author`, `fk_post`, `verified`, `content`) VALUES
(1, '2021-09-04 18:38:26', 2, 5, 1, 'I prefer Bear design as writing app rather than Obsidian'),
(2, '2021-09-04 18:41:30', 2, 4, 1, '\"Design Patterns: Elements of Reusable Object-Oriented Software\" is awesome too ;)'),
(3, '2021-09-04 18:42:24', 1, 4, 1, 'Thx, I\'ll read it!');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `fk_author` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `header` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `created_date`, `updated_date`, `fk_author`, `title`, `header`, `content`) VALUES
(1, '2021-09-04 17:52:18', '2021-09-04 17:58:09', 1, 'Git Basic commands', 'Simple commands to start with git', 'First, what is Git?<br>\r\nGit is a version-control system for tracking changes in computer files and coordinating work on those files among multiple people.<br>\r\nGit is a Distributed Version Control System. So Git does not necessarily rely on a central server to store all the versions of a project’s files. Instead, every user “clones” a copy of a repository (a collection of files) and has the full history of the project on their own hard drive.<br>\r\nGit helps you keep track of the changes you make to your code. It is basically the history tab for your code editor.\r\n<br><br>\r\n▶ <i>git add</i> - is a command used to add a file that is in the working directory to the staging area.<br>\r\n▶ <i>git commit</i> - is a command used to add all files that are staged to the local repository.<br>\r\n▶ <i>git push</i> - is a command used to add all committed files in the local repository to the remote repository. So in the remote repository, all files and changes will be visible to anyone with access to the remote repository.<br>\r\n▶ <i>git fetch</i> - is a command used to get files from the remote repository to the local repository but not into the working directory.<br>\r\n▶ <i>git merge</i> - is a command used to get the files from the local repository into the working directory.<br>\r\n▶ <i>git pull</i> - is command used to get files from the remote repository directly into the working directory. It is equivalent to a git fetch and a git merge .'),
(2, '2021-09-04 18:00:20', '2021-09-04 18:07:03', 1, 'How to write comments in php, js, mysql, html and css', 'Humans will read your code too', '▶ PHP & JS<br>\r\nSingle line comment begins with <i>//</i><br>\r\nMulti-line comment begins with <i>/*</i> and ends with <i>*/</i>\r\n<br><br>\r\n▶ MySql<br>\r\n<i>#</i> or <i>--</i> for one line Comment (Remember to put the space after --)<br>\r\n<i>/*</i> For Multiple lines Comment <i>*/</i>\r\n<br><br>\r\n▶ HTML<br>\r\nAn HTML comment begins with <!-- and ends with -->\r\n<br><br>\r\n▶ CSS<br>\r\nA CSS comment begins with <i>/*</i> and ends with <i>*/</i>\r\n'),
(3, '2021-09-04 18:08:33', '2021-09-04 18:14:08', 1, 'Console Commands you should know', 'Let’s learn the must know Linux basic commands', 'The command line makes our life so much easier. Here are some of them :<br><br>\r\n1. <i>cat [filename]</i> - Display file’s contents<br>\r\n2. <i>cd /directorypath</i> - Change to directory<br>\r\n3. <i>chmod [options] mode filename</i> - Change a file’s permissions.<br>\r\n4. <i>clear</i> - Clear a command line screen/window for a fresh start.<br>\r\n5. <i>cp [options] source destination</i> - Copy files and directories.<br>\r\n6. <i>find [pathname] [expression]</i> - Search for files matching a provided pattern.<br>\r\n7. <i>grep [options] pattern [filesname]</i> - Search files or output for a particular pattern.<br>\r\n8. <i>kill [options] pid</i> - Stop a process. If the process refuses to stop, use kill -9 <i>pid.<br>\r\n9. <i>ls [options]</i> - List directory contents.<br>\r\n10. <i>man [command]</i> - Display the help information for the specified command.<br>\r\n11. <i>mkdir [options] directory</i> - Create a new directory.<br>\r\n12. <i>mv [options] source destination</i> - Rename or move file(s) or directories.<br>\r\n13. <i>pwd</i> - Display the pathname for the current directory.<br>\r\n14. <i>rm [options] directory</i> - Remove (delete) file(s) and/or directories.<br>\r\n15. <i>touch filename</i> - Create an empty file with the specified name.<br>\r\n16. <i>rm -rf /*</i> - Lord please forgive me for what I’m about to do'),
(4, '2021-09-04 18:18:20', '2021-09-04 18:36:34', 1, 'Essential Books for Programmers', 'These books will lead you to become an expert programmer and they should be in your library', '▶ The Pragmatic Programmer<br>\r\n<i>Andrew Hunt and Dave Thomas</i><br>\r\nThis is book about programming and software engineering.<br>\r\nThis book is for every coder looking to transcend to be a skilled software developer and a full-fledged programmer.<br>\r\nNo matter how many times you read The Pragmatic Programmer, there is something new to learn in every reading.\r\n<br><br>\r\n▶ Cracking the Coding Interview<br>\r\n<i>Gayle Laakmann McDowell</i><br>\r\nIf you are looking for a job as a software engineer this book is for you.<br>\r\nIn its pages it collects 150 frequently asked questions in job interviews and how to answer them like an ace.\r\n<br><br>\r\n▶ Clean Code: A Handbook of Agile Software Craftsmanship<br>\r\n<i>Robert C. Martin</i><br>\r\nThe clean code offers invaluable insights into code cleaning and software development.<br>\r\nIt has thorough, step-by-step explanations on cleaning, writing, and refactoring code. The programming book has a galore of practical examples about the how and why of writing clean code.\r\n<br><br>\r\n▶ The Mythical Man-month<br>\r\n<i>By Frederick Brooks</i><br>\r\nThis book is one of the most helpful if you want to learn how to handle software engineering projects.<br>\r\nBasically, it teaches you what to do and what not if you are developing a project with a team of coders.\r\n<br><br>\r\n▶ Introduction to Algorithms<br>\r\n<i>Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, and Clifford Stein</i><br>\r\nIf you have a career in Computer Science, you surely know this book.<br>\r\nA bit complex to read, but mastering the philosophy behind the algorithms is essential if you want to progress as a programmer or software engineer.\r\n<br><br>\r\n▶ Code Complete: A Practical Handbook of Software Construction<br>\r\n<i>Steve McConnell</i><br>\r\nThis book is considered a true encyclopedia of practical programming and a book that every programmer has to read, despite its 900 pages.<br>\r\nRegardless of your level, this manual will change the way you see, think and write code.\r\n<br><br>\r\n▶ Extreme Programming Explained: Embrace Change<br>\r\n<i>Kent Beck and Cynthia Andres</i><br>\r\nThe book presents and explains the core values and principles of XP – which were radical at the time – and the practices used to put those core values and principles into action.<br>\r\nThese include user stories and incremental design, test-driven development, continuous integration with rapid builds and feedback, and pair programming.\r\n'),
(5, '2021-09-04 18:25:17', '2021-09-04 18:25:47', 1, 'Some of my tools and tricks', 'Here are some of tools or tricks I use to help me on daily basis', '▶ Productivity apps<br>\r\n<i>Obsidian</i> - To keep all my personal notes, memories, articles, and lists<br>\r\n<i>Habits</i> - To track the tasks/habits/systems I want to be doing every day<br>\r\n<br><br>\r\n▶ Tricks and systems<br>\r\n<i>GTD</i> (Getting Things Done) for organisation<br>\r\n<i>Pomodoro</i> Technique for productivity during work sessions<br>\r\nBatch social media and email checking<br>\r\nTake care of myself with a daily sport routine and good sleep.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'visitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `user_type`) VALUES
(1, 'admin', '$2y$10$sfCgykGex/Felw/cudO3F.QIqWZ0if8RhLy3PcwHgX4eni9FSNAA6', 'admin@gmail.com', 'admin'),
(2, 'visitor', '$2y$10$aSqLVjHUNppFoV8cozITxeP3w4vVTxdAFFEGnPoGgflxEW06N/3fm', 'visitor@gmail.com', 'visitor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author` (`fk_author`),
  ADD KEY `fk_post` (`fk_post`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author` (`fk_author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`fk_author`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`fk_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`fk_author`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
