-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-06-2025 a las 09:04:15
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bookcabinet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `pages` int DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `isbn_13` varchar(13) DEFAULT NULL,
  `description` text,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publication_date`, `categories`, `pages`, `publisher`, `isbn_13`, `description`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, 'Carrie', 'Stephen King', '0000-00-00', 'Bullying', 0, 'Pocket Books', '9781416524304', 'Carrie is a 16 year-old girl who is repressed by her fanatical mother. She is humiliated by her classmates for her ignorance of the facts of life. However, she possesses terrifying telekinetic powers that could make inanimate objects move. After being humiliated once too often, her inner rage erupts.', 'http://books.google.com/books/content?id=JRJ-PwAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:18:27', '2025-06-04 13:18:27'),
(2, '\'Salem\'s Lot', 'Stephen King', '0000-00-00', 'Fiction in English', 483, 'Editorial no disponible', '9780450031069', 'Thousands of miles away from the small township of \'Salem\'s Lot, two terrified people, a man and a boy, still share the secrets of those clapboard houses and tree-lined streets. They must return to \'Salem\'s Lot for a final confrontation with the unspeakable evil that lives on in the town.', 'http://books.google.com/books/content?id=Phq_RwAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:18:56', '2025-06-04 13:18:56'),
(3, 'The Shining', 'Stephen King', '0000-00-00', 'Boys', 416, 'Editorial no disponible', '9780450040184', 'Danny is only five years old, but he is a \'shiner\', aglow with psychic voltage. When his father becomes caretaker of an old hotel, his visions grow out of control. Cut off by blizzards, the hotel seems to develop an evil force, and who are the mysterious guests in the supposedly empty hotel?', 'http://books.google.com/books/content?id=tVt-uQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:19:23', '2025-06-04 13:19:23'),
(4, 'The Outsider', 'Stephen King', '2018-05-22', 'Fiction', 576, 'Scribner', '9781501180989', 'Now an HBO limited series starring Ben Mendelsohn!​ Evil has many faces…maybe even yours in this #1 New York Times bestseller from master storyteller Stephen King. An eleven-year-old boy’s violated corpse is discovered in a town park. Eyewitnesses and fingerprints point unmistakably to one of Flint City’s most popular citizens—Terry Maitland, Little League coach, English teacher, husband, and father of two girls. Detective Ralph Anderson, whose son Maitland once coached, orders a quick and very public arrest. Maitland has an alibi, but Anderson and the district attorney soon have DNA evidence to go with the fingerprints and witnesses. Their case seems ironclad. As the investigation expands and horrifying details begin to emerge, King’s story kicks into high gear, generating strong tension and almost unbearable suspense. Terry Maitland seems like a nice guy, but is he wearing another face? When the answer comes, it will shock you as only Stephen King can.', 'http://books.google.com/books/content?id=yK_iyQEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:20:00', '2025-06-04 13:20:00'),
(5, 'Cabal', 'Clive Barker', '0000-00-00', 'Fiction', 372, 'Simon and Schuster', '9780743417327', '\"Some of the stories in this volume have been previously published in Great Britain by Sphere Books, Ltd.\"--T.p. verso.', 'http://books.google.com/books/content?id=Lf0w6q7PBFkC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', '2025-06-04 13:20:43', '2025-06-04 13:20:43'),
(6, 'Clive Barker\'s Books of Blood 1-3', 'Clive Barker', '0000-00-00', 'Fiction', 530, 'Berkley', '9780425165584', 'A collection of short horror fiction stories written by Clive Barker in the early years of his career.', 'http://books.google.com/books/content?id=q9hoAAAAMAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:21:54', '2025-06-04 13:21:54'),
(7, 'The Hellbound Heart', 'Clive Barker', '1991-12-05', 'Fiction', 180, 'Harper Collins', '9780061002823', 'From his Books of Blood to The Damnation Game, Weaveworld, and The Great and Secret Show, to scores of short stories, bestselling novels, and now major motion pictures, no one comes close to the vivid imagination and unique terrors provided by Clive Barker. The Hellbound Heart is one of his best, a nerve-shattering novella about the human heart and all the great terrors and ecstasies within its endless domain. It is about greed and love, lovelessness and despair, desire and death, life and captivity, bells and blood. It is one of the most dead-frightening stories you are likely to ever read.', 'http://books.google.com/books/content?id=eGOcBYDiyysC&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:22:18', '2025-06-04 13:22:18'),
(8, 'At the Mountains of Madness', 'H.P. Lovecraft', '2005-06-14', 'Fiction', 228, 'Modern Library', '9780812974416', 'At the mountains of madness: An old man consents to a radio interview and a number of terrible truths are revealed about an expedition of Antarctica in the 1920\'s where everyone died horribly.', 'http://books.google.com/books/content?id=iEGwAAAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:22:51', '2025-06-04 13:22:51'),
(9, 'The Case of Charles Dexter Ward', 'Howard Phillips Lovecraft', '0000-00-00', 'Good and evil', 0, 'Del Rey', '9780345354907', 'Incantations of black magic unearthed unspeakable horrors in a quiet town near Providence, Rhode Island. Evil spirits are being resurrected from beyond the grave, a supernatural force so twisted that it kills without offering the mercy of death!', 'http://books.google.com/books/content?id=4Wf6PwAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:23:01', '2025-06-04 13:23:01'),
(10, 'The Dunwich Horror', 'H. P. Lovecraft', '2016-09-21', 'Categoría no disponible', 44, 'Createspace Independent Publishing Platform', '9781537765624', 'The story of Wilbur Whateley, son of a deformed albino mother and an unknown father, and the strange events surrounding his birth and precocious development. Wilbur matures at an abnormal rate, reaching manhood within a decade--all the while indoctrinated him into dark rituals and witchcraft by his grandfather. Show Excerpt dingly ugly despite his appearance of brilliancy; there being something almost goatish or animalistic about his thick lips, large-pored, yellowish skin, coarse crinkly hair, and oddly elongated ears. He was soon disliked even more decidedly than his mother and grandsire, and all conjectures about him were spiced with references to the bygone magic of Old Whateley, and how the hills once shook when he shrieked the dreadful name of Yog-Sothoth in the midst of a circle of stones with a great book open in his arms before him. Dogs abhorred the boy, and he was always obliged to take various defensive measures against their barking menace. III. Meanwhile Old Whateley continued to buy cattle without measurably increasing the size of his herd. He also cut timber and began to repair the unused parts of his house - a spacious, peak-roofed affair whose rear end was buried entirely in the rocky hillside, and whose three least-ruined ground-floor rooms had always been sufficient for himself and his daughter.', 'http://books.google.com/books/content?id=WTFkvgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:23:19', '2025-06-04 13:23:19'),
(11, 'The Rats in the Walls', 'Howard Phillips Lovecraft', '0000-00-00', 'Categoría no disponible', 95, 'Editorial no disponible', '9782266150224', 'Le narrateur, descendant d\'une respectable lignée virginienne, rachète le siège historique de sa famille, situé en Angleterre, d\'où un de ses ancêtres s\'était enfui dans des circonstances mystérieuses. Il décide de faire restaurer l\'ancien édifice, qui a dans la région une réputation maléique... H. P. Lovecraft, le fondateur du mythe de Cthulhu, déploie ici tout son art, où réalisme et détails concrets sous-tendent les suggestions d\'abominations indicibles.', './uploads/covers/default-cover.jpeg', '2025-06-04 13:23:42', '2025-06-04 13:23:42'),
(12, 'Herbert West', 'H. P. Lovecraft', '0000-00-00', 'Fiction', 0, 'Editorial no disponible', '9781409936480', 'Howard Phillips Lovecraft (1890-1937) was an American author of horror, fantasy, and science fiction, known then simply as weird fiction. His major inspiration and invention was cosmic horror: the idea that life is incomprehensible to human minds and that the universe is fundamentally alien. Those who genuinely reason, like his protagonists, gamble with sanity. He has developed a cult following for his Cthulhu Mythos, a series of loosely interconnected fictions featuring a pantheon of human-nullifying entities, as well as the Necronomicon, a fictional grimoire of magical rites and forbidden lore. His works were deeply pessimistic and cynical, challenging the values of Enlightenment, Romanticist, and Christian humanism. Lovecraft\'s protagonists usually achieve the mirror-opposite of traditional gnosis and mysticism by momentarily glimpsing the horror of ultimate reality. Although Lovecraft\'s readership was limited during his life, his reputation has grown over the decades, and he is now commonly regarded as one of the most influential horror writers of the 20th century, exerting widespread and indirect influence, and frequently compared to Edgar Allan Poe.', 'http://books.google.com/books/content?id=H5tMPgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:24:13', '2025-06-04 13:24:13'),
(13, 'The Conspiracy Against the Human Race', 'Thomas Ligotti', '0000-00-00', 'Literary Criticism', 246, 'Editorial no disponible', '9780982429693', 'The Conspiracy against the Human Race is renowned horror writer Thomas Ligotti\'s first work of nonfiction. Through impressively wide-ranging discussions of and reflections on literary and philosophical works of a pessimistic bent, he shows that the greatest horrors are inherent both to the human situation and to reality itself, and are not the products of our imagination.', './uploads/covers/default-cover.jpeg', '2025-06-04 13:24:45', '2025-06-04 13:24:45'),
(14, 'Teatro Grottesco', 'Thomas Ligotti', '0000-00-00', 'Horror tales, American', 312, 'Editorial no disponible', '9780978991173', 'Descripción no disponible', './uploads/covers/default-cover.jpeg', '2025-06-04 13:24:54', '2025-06-04 13:24:54'),
(15, 'Songs of a Dead Dreamer and Grimscribe', 'Thomas Ligotti', '2015-10-06', 'Fiction', 466, 'Penguin Classics', '9780143107767', 'Thomas Ligotti\'s debut collection, Songs of a Dead Dreamer, and his second, Grimscribe, permanently inscribed a new name in the pantheon of horror fiction. Influenced by the strange terrors of Lovecraft and Poe and by the brutal absurdity of Kafka, Ligotti crafted his own brand of existential horror, which shocks at the deepest levels. In decaying cities and lurid dreamscapes tormented by the lunatic pageantry of masks, puppets, and obscure ritual, Ligotti\'s works lay bare the sickening madness of the human condition. From his dark imagination emerge stories like \"The Frolic\" and \"The Last Feast of Harlequin,\" waking nightmares that splinter the schemes validating our existence. In these collections, Ligotti bends reality until it cracks, opening fissures through which he invites us to gaze on the unsettling darkness below-an ordeal from which one may perhaps return, but never to be the same', 'http://books.google.com/books/content?id=YHPZCwAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:25:02', '2025-06-04 13:25:02'),
(16, 'Noctuary', 'Thomas Ligotti', '0000-00-00', 'Fiction', 194, 'Carroll & Graf Pub', '9780786702350', 'Descripción no disponible', 'http://books.google.com/books/content?id=Wpf9PAAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:25:24', '2025-06-04 13:25:24'),
(17, 'The Spectral Link', 'Thomas Ligotti', '0000-00-00', 'Horror tales', 0, 'Editorial no disponible', '9781596066502', 'The unnamed narrator of \"Metaphysica Morum\" seeks suicide, yet delays until he can subvert the optimism of his fugitive therapist. Equally anonymous, the young narrator of \"The Small People\" finds a growing horror in the encroachment of toy-like beings that bring an unsettling enlightenment about the shabbiness of daily life and the true nature of his parents', './uploads/covers/default-cover.jpeg', '2025-06-04 13:25:36', '2025-06-04 13:25:36'),
(18, 'Boys in the Valley', 'Philip Fracassi', '2023-07-11', 'Fiction', 0, 'Tor Nightfire', '9781250879035', 'The Exorcist meets Lord of the Flies, by way of Midnight Mass, in Boys in the Valley, a brilliant coming-of-age tale from award-winning author Philip Fracassi. St. Vincent\'s Orphanage for Boys. Turn of the century, in a remote valley in Pennsylvania. Here, under the watchful eyes of several priests, thirty boys work, learn, and worship. Peter Barlow, orphaned as a child by a gruesome murder, has made a new life here. As he approaches adulthood, he has friends, a future...a family. Then, late one stormy night, a group of men arrive at their door, one of whom is badly wounded, occult symbols carved into his flesh. His death releases an ancient evil that spreads like sickness, infecting St. Vincent\'s and the children within. Soon, boys begin acting differently, forming groups. Taking sides. Others turn up dead. Now Peter and those dear to him must choose sides of their own, each of them knowing their lives — and perhaps their eternal souls — are at risk.', 'http://books.google.com/books/content?id=1r5_EAAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:26:12', '2025-06-04 13:26:12'),
(19, 'Gothic', 'Philip Fracassi', '2023-02-02', 'Categoría no disponible', 0, 'Editorial no disponible', '9781587678400', 'On his 59th birthday, Tyson Parks-a famous, but struggling, horror writer-receives an antique desk from his partner, Sarah, in the hopes it will rekindle his creative juices. Perhaps inspire him to write another best-selling novel and prove his best years aren\'t behind him. A continent away, a mysterious woman makes inquiries with her sources around the world, seeking the whereabouts of a certain artifact her family has been hunting for centuries. With the help of a New York City private detective, she finally finds what she\'s been looking for. It\'s in the home of Tyson Parks.- Meanwhile, as Tyson begins to use his new desk, he begins acting... strange. Violent. His writing more disturbing than anything he\'s done before. But publishers are paying top dollar, convinced his new work will be a hit, and Tyson will do whatever it takes to protect his newfound success. Even if it means the destruction of the ones he loves. Even if it means his own sanity. Philip Fracassi is the Bram Stoker-nominated author of the story collections Behold the Void (named \"Collection of the Year\" from This Is Horror) and Beneath a Pale Sky (named \"Collection of the Year\" by Rue Morgue Magazine). His novels include A Child Alone with Strangers, and the upcoming Boys in the Valley. Philip\'s work has been translated into multiple languages, and his stories have been published in numerous magazines and anthologies, including Best Horror of the Year, Nightmare Magazine, and Black Static. The New York Times calls his work \"terrifically scary.\" \"Not since The Shining has the descent of a writer into madness been so masterfully rendered on the page.\" - Ross Jeffery, Bram Stoker-nominated author of Tome \"A high creep factor chiller with a sinister edge that had me reading well past my bedtime. Frightening and fun, and deliciously original!\" - James A Moore, author of the Blood Red trilogy and Cherry Hill. \"Fracassi takes the familiar traps-love, obsession, power-and gives them new teeth. It\'s dark fun twisted tightly around a story of human frailty...He\'s doing for the desk what King did for the car.\" - Jeff Terry, THE JEFF WORD \"Fracassi\'s page-turning thriller offers unapologetic horror raised to the next level with strong characterization, great pacing, and visceral details that ensure we experience unspeakable dread alongside the book\'s protagonist. I think I went a little insane while reading it.\" --Norman Prentiss, author of Haunted Attractions with your Other Father and The Apocalypse-a-Day Desk Calendar \"Stylish, atmospheric, and chilling, GOTHIC is an affectionate ode to the horror greats, and an effective reminder that Philip Fracassi is destined to become one of them. One of my favorite reads of the year so far.\"- Kealan Patrick Burke, Bram Stoker Award-winning author of Kin and Sour Candy \"\"GOTHIC is the literary equivalent of the abyss gazing right back at you from the hellish depths of its pages. Don\'t lean in too close, lest you fall into this nightmarish novel and never find your way out again.\" - Clay MacLeod Chapman, author of Ghost Eaters \"A diabolical novel! Fracassi pens this one with furious, devilish glee. Readers--and writers--of horror fiction will love it.\" - Ronald Malfi, author of Come with Me and Black Mouth', 'http://books.google.com/books/content?id=eSmczwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 13:26:21', '2025-06-04 13:26:21'),
(20, 'Inwijding van het nieuwe gedeelte van het Diaconessenhuis Westersingel 115 te Rotterdam', 'Autor no disponible', '0000-00-00', 'Categoría no disponible', 18, 'Editorial no disponible', '9780692617045', 'Descripción no disponible', './uploads/covers/default-cover.jpeg', '2025-06-04 13:26:42', '2025-06-04 13:26:42'),
(21, 'Six of Crows', 'Leigh Bardugo', '2015-09-29', 'Juvenile Fiction', 479, 'Macmillan', '9781627792127', 'The Grishaverse will be coming to Netflix soon with Shadow and Bone, an original series Enter the Grishaverse with the #1 New York Times-bestselling Six of Crows. Ketterdam: a bustling hub of international trade where anything can be had for the right price--and no one knows that better than criminal prodigy Kaz Brekker. Kaz is offered a chance at a deadly heist that could make him rich beyond his wildest dreams. But he can\'t pull it off alone. . . . A convict with a thirst for revenge. A sharpshooter who can\'t walk away from a wager. A runaway with a privileged past. A spy known as the Wraith. A Heartrender using her magic to survive the slums. A thief with a gift for unlikely escapes. Six dangerous outcasts. One impossible heist. Kaz\'s crew is the only thing that might stand between the world and destruction--if they don\'t kill each other first. Six of Crows by Leigh Bardugo returns to the breathtaking world of the Grishaverse in this unforgettable tale about the opportunity--and the adventure--of a lifetime. \"Six of Crows is a twisty and elegantly crafted masterpiece that thrilled me from the beginning to end.\" -New York Times-bestselling author Holly Black \"Six of Crows is] one of those all-too-rare, unputdownable books that keeps your eyes glued to the page and your brain scrambling to figure out what\'s going to happen next.\" -Michael Dante DiMartino, co-creator of Avatar: The Last Airbender and The Legend of Korra \"There\'s conflict between morality and amorality and an appetite for sometimes grimace-inducing violence that recalls the Game of Thrones series. But for every bloody exchange there are pages of crackling dialogue and sumptuous description. Bardugo dives deep into this world, with full color and sound. If you\'re not careful, it\'ll steal all your time.\" --The New York Times Book Review Praise for the Grishaverse \"A master of fantasy.\" --The Huffington Post \"Utterly, extremely bewitching.\" --The Guardian \"The best magic universe since Harry Potter.\" --Bustle \"This is what fantasy is for.\" --The New York Times Book Review \" A] world that feels real enough to have its own passport stamp.\" --NPR \"The darker it gets for the good guys, the better.\" --Entertainment Weekly \"Sultry, sweeping and picturesque. . . . Impossible to put down.\" --USA Today \"There\'s a level of emotional and historical sophistication within Bardugo\'s original epic fantasy that sets it apart.\" --Vanity Fair \"Unlike anything I\'ve ever read.\" --Veronica Roth, bestselling author of Divergent \"Bardugo crafts a first-rate adventure, a poignant romance, and an intriguing mystery \" --Rick Riordan, bestselling author of the Percy Jackson series \"This is a great choice for teenage fans of George R.R. Martin and J.R.R. Tolkien.\" --RT Book Reviews Read all the books in the Grishaverse The Shadow and Bone Trilogy (previously published as The Grisha Trilogy) Shadow and Bone Siege and Storm Ruin and Rising The Six of Crows Duology Six of Crows Crooked Kingdom The Language of Thorns: Midnight Tales and Dangerous Magic', 'http://books.google.com/books/content?id=ZCtfCgAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:03:53', '2025-06-04 15:03:53'),
(22, 'Mistborn', 'Brandon Sanderson', '2006-07-25', 'Fiction', 542, 'Macmillan', '9780765311788', '\"What if the prophesied hero failed to defeat the Dark Lord?\"--Jacket.', 'http://books.google.com/books/content?id=dlfOfxkm1PoC&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:04:19', '2025-06-04 15:04:19'),
(23, 'The Name of the Wind', 'Patrick Rothfuss', '2007-03-27', 'Fiction', 674, 'Penguin', '9780756404079', 'Kvothe spends his life fighting hidden and familiar foes while struggling to master his magical powers and battle ancient evils that threaten his world.', 'http://books.google.com/books/content?id=DSyJEAAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:04:41', '2025-06-04 15:04:41'),
(24, 'A Clash of Kings', 'George R. R. Martin', '2002-05-28', 'Fiction', 785, 'Random House Worlds', '9780553381696', 'THE BOOK BEHIND THE SECOND SEASON OF GAME OF THRONES, AN ORIGINAL SERIES NOW ON HBO. Here is the second book in the landmark series that has redefined imaginative fiction and become a modern masterpiece. A CLASH OF KINGS A comet the color of blood and flame cuts across the sky. And from the ancient citadel of Dragonstone to the forbidding shores of Winterfell, chaos reigns. Six factions struggle for control of a divided land and the Iron Throne of the Seven Kingdoms, preparing to stake their claims through tempest, turmoil, and war. It is a tale in which brother plots against brother and the dead rise to walk in the night. Here a princess masquerades as an orphan boy; a knight of the mind prepares a poison for a treacherous sorceress; and wild men descend from the Mountains of the Moon to ravage the countryside. Against a backdrop of incest and fratricide, alchemy and murder, victory may go to the men and women possessed of the coldest steel . . . and the coldest hearts. For when kings clash, the whole land trembles. A GAME OF THRONES • A CLASH OF KINGS • A STORM OF SWORDS • A FEAST FOR CROWS • A DANCE WITH DRAGONS', 'http://books.google.com/books/content?id=NnE07xtwhqYC&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:04:51', '2025-06-04 15:04:51'),
(25, 'The Cruel Prince', 'Holly Black', '2018-01-02', 'Young Adult Fiction', 384, 'Little, Brown Books for Young Readers', '9780316310277', 'An instant bestseller! By #1 New York Times bestselling author Holly Black, the first book in a stunning new series about a mortal girl who finds herself caught in a web of royal faerie intrigue. Of course I want to be like them. They\'re beautiful as blades forged in some divine fire. They will live forever. And Cardan is even more beautiful than the rest. I hate him more than all the others. I hate him so much that sometimes when I look at him, I can hardly breathe. Jude was seven years old when her parents were murdered and she and her two sisters were stolen away to live in the treacherous High Court of Faerie. Ten years later, Jude wants nothing more than to belong there, despite her mortality. But many of the fey despise humans. Especially Prince Cardan, the youngest and wickedest son of the High King. To win a place at the Court, she must defy him--and face the consequences. In doing so, she becomes embroiled in palace intrigues and deceptions, discovering her own capacity for bloodshed. But as civil war threatens to drown the Courts of Faerie in violence, Jude will need to risk her life in a dangerous alliance to save her sisters, and Faerie itself.', 'http://books.google.com/books/content?id=2dV3swEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:05:04', '2025-06-04 15:05:04'),
(26, 'Percy Jackson and the Olympians, Book One: Lightning Thief Disney+ Tie in Edition', 'Rick Riordan', '2023-11-21', 'Juvenile Fiction', 0, 'Disney-Hyperion', '9781368098168', 'The first book in the New York Times best-selling saga with a cover image and an 8-page photo insert from the Disney+ series! Read the book that launched Percy Jackson into the stratosphere before the Disney+ series comes out! Lately, mythological monsters and the Olympian gods seem to be walking straight out of the pages of Percy Jackson\'s Greek mythology textbook and into his life. Zeus\'s master lightning bolt has been stolen, and Percy is the prime suspect. Percy and his friends have just ten days to find and return Zeus\'s stolen property and bring peace to a warring Mount Olympus. Whether you are new to Percy or a longtime fan, this tie-in paperback edition with full-color photos from the Disney+ series is a must-have for your library.', 'http://books.google.com/books/content?id=u-vUzwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:05:13', '2025-06-04 15:05:13'),
(27, 'The Lion, the Witch and the Wardrobe', 'C. S. Lewis', '2009-10-06', 'Juvenile Fiction', 152, 'Harper Collins', '9780061974151', 'The Lion, the Witch and the Wardrobe is the second book in C. S. Lewis\'s The Chronicles of Narnia, a series that has become part of the canon of classic literature, drawing readers of all ages into a magical land with unforgettable characters for over fifty years. Four adventurers step through a wardrobe door and into the land of Narnia, a land enslaved by the power of the White Witch. But when almost all hope is lost, the return of the Great Lion, Aslan, signals a great change . . . and a great sacrifice. This ebook contains the complete text and art. Illustrations in this ebook appear in vibrant full color on a full-color ebook device and in rich black-and-white on all other devices. This is a stand-alone read, but if you would like to explore more of the Narnian realm, pick up The Horse and His Boy, the third book in The Chronicles of Narnia.', 'http://books.google.com/books/content?id=Vdo2eIcwdlEC&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:05:56', '2025-06-04 15:05:56'),
(28, 'Eragon', 'Christopher Paolini', '2005-04-26', 'Young Adult Fiction', 532, 'Knopf Books for Young Readers', '9780375826696', 'Don’t miss the eagerly anticipated epic new fantasy from Christopher Paolini—Murtagh! A new adventure hatches in Book One of the Inheritance Cycle, perfect for fans of Lord of the Rings! This New York Times bestselling series has sold over 40 million copies and is an international fantasy sensation. \"Christopher Paolini is a true rarity.\" —The Washington Post When fifteen-year-old Eragon finds a polished blue stone in the forest, he thinks it is the lucky discovery of a poor farm boy. But when the stone brings a dragon hatchling, Eragon soon realizes he has stumbled upon a legacy nearly as old as the Empire itself. Overnight his simple life is shattered, and, gifted with only an ancient sword, a loyal dragon, and sage advice from an old storyteller, Eragon is soon swept into a dangerous tapestry of magic, glory, and power. Now his choices could save—or destroy—the Empire. This updated edition of Eragon includes: · A sneak peek of Murtagh · One section of a brand-new Alagaësia map by Christopher, with a unique code that will unlock a different piece of exclusive digital content. Collect all 4 books in the Inheritance Cycle to see the full map and unlock all bonus content! · A redesigned cover using the iconic original art', 'http://books.google.com/books/content?id=gabGYKgIQr8C&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:06:05', '2025-06-04 15:06:05'),
(29, 'The Night Circus', 'Erin Morgenstern', '2011-09-13', 'Fiction', 0, 'National Geographic Books', '9780385534635', 'The circus arrives without warning. No announcements precede it. It is simply there, when yesterday it was not. Within the black-and-white striped canvas tents is an utterly unique experience full of breathtaking amazements. It is called Le Cirque des Rêves, and it is only open at night. But behind the scenes, a fierce competition is underway—a duel between two young magicians, Celia and Marco, who have been trained since childhood expressly for this purpose by their mercurial instructors. Unbeknownst to them, this is a game in which only one can be left standing, and the circus is but the stage for a remarkable battle of imagination and will. Despite themselves, however, Celia and Marco tumble headfirst into love—a deep, magical love that makes the lights flicker and the room grow warm whenever they so much as brush hands. True love or not, the game must play out, and the fates of everyone involved, from the cast of extraordinary circus per­formers to the patrons, hang in the balance, suspended as precariously as the daring acrobats overhead. Written in rich, seductive prose, this spell-casting novel is a feast for the senses and the heart.', 'http://books.google.com/books/content?id=FEGNEAAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-04 15:06:13', '2025-06-04 15:06:13'),
(30, 'Cementerio de animales', 'Stephen King', '2005-06-30', 'Terror', 488, 'Debolsillo', '9788497930994', 'Un hermoso día de agosto, el doctor Louis Creed llega con su esposa Rachel, sus hijos Eileen y Gage y el gato Church a su nuevo hogar, una gran casa situada en las afueras de Ludlow, Nueva Inglaterra. El lugar parece tranquilo y lo bastante alejado del ajetreo urbano. Detrás de la casa de los Creed hay incluso un campo de enterramientos, en donde los niños del lugar han sepultado a sus animales durante generaciones: el Cementerio de animales. Pero enseguida empieza la pesadilla... al menos para Louis. En su primer día de trabajo en el centro médico de la Universidad de Maine, le llevan el cuerpo horriblemente mutilado del estudiante Victor Pascow. El joven trata de advertir al doctor Creed acerca del lugar situado detrás del Cementerio de a', './uploads/covers/47835.jpg', '2025-06-16 10:46:31', '2025-06-16 10:46:31'),
(31, 'It : [a novel]', 'Stephen King', '0000-00-00', 'Horror tales', 1116, 'Editorial no disponible', '9780450411434', '\"They were seven teenagers when they first stumbled upon the horror. Now they were grown-up men and women who had gone out into the big world to gain success and happiness. But none of them could withstand the force that drew them back to Derry, Maine to face the nightmare without an end, and the evil without a name. What was it? Read It and find out...if you dare!\" - product description.', 'http://books.google.com/books/content?id=ZVzRcQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', '2025-06-16 18:33:22', '2025-06-16 18:33:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_details`
--

DROP TABLE IF EXISTS `book_details`;
CREATE TABLE IF NOT EXISTS `book_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `collection_id` int NOT NULL,
  `rating` tinyint DEFAULT NULL,
  `review` text,
  `status` enum('abandoned','not started','reading','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `copies` int DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_book_details_users` (`user_id`),
  KEY `fk_book_details_books` (`book_id`),
  KEY `fk_book_details_collections` (`collection_id`)
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_tags`
--

DROP TABLE IF EXISTS `book_tags`;
CREATE TABLE IF NOT EXISTS `book_tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_id` int NOT NULL,
  `tag_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id` (`book_id`,`tag_id`),
  KEY `fk_book_tags_tag` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collections`
--

DROP TABLE IF EXISTS `collections`;
CREATE TABLE IF NOT EXISTS `collections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `share_token` varchar(64) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `share_token` (`share_token`),
  KEY `fk_collections_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `collections`
--

INSERT INTO `collections` (`id`, `user_id`, `title`, `description`, `share_token`, `created_at`, `updated_at`) VALUES
(7, 17, 'colección prueba 1', 'prueba de colección 1', NULL, '2025-06-17 13:05:12', '2025-06-17 13:05:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collection_books`
--

DROP TABLE IF EXISTS `collection_books`;
CREATE TABLE IF NOT EXISTS `collection_books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `collection_id` int NOT NULL,
  `book_id` int NOT NULL,
  `added_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `notes` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `collection_id` (`collection_id`,`book_id`),
  KEY `fk_collection_books_books` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `collection_books`
--

INSERT INTO `collection_books` (`id`, `collection_id`, `book_id`, `added_at`, `notes`) VALUES
(180, 7, 10, '2025-06-17 13:05:47', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `collection_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users` (`user_id`),
  KEY `fk_comments_collections` (`collection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remember_token` varchar(255) DEFAULT NULL,
  `level` enum('free','premium') NOT NULL DEFAULT 'free',
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`, `updated_at`, `remember_token`, `level`, `country`, `role`) VALUES
(15, 'Anglesoryu', 'Anglesoryu@gmail.com', '$2y$10$jO3RlzzukyDbWUAgosHACOvQZMFOYINf8Tly3l81zeQZEGX1Car12', '2025-06-09 13:06:47', '2025-06-09 13:07:09', NULL, 'free', 'ES', 'user'),
(17, 'prueba93', 'prueba@gmail.com', '$2y$10$JE8ANUdbwo8kWxCdeicuuuLnVsavOWufE7Sil0IzVsga/wwFsivUm', '2025-06-17 13:04:45', '2025-06-17 13:04:45', NULL, 'free', 'ES', 'user');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `book_details`
--
ALTER TABLE `book_details`
  ADD CONSTRAINT `fk_book_details_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_details_collections` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_details_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `book_tags`
--
ALTER TABLE `book_tags`
  ADD CONSTRAINT `fk_book_tags_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_book_tags_tag` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `fk_collections_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `collection_books`
--
ALTER TABLE `collection_books`
  ADD CONSTRAINT `fk_collection_books_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_collection_books_collections` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_collections` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
