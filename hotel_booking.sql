-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 18, 2022 at 07:24 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', 'admin123', 'admin@admin', 'admin'),
(2, 'user', 'user', 'user@user', 'user'),
(3, 'hotel', 'hotel', 'hotel@gmail.com', 'hmanager'),
(4, 'manager', 'manager', 'manager@gmail.com', 'hmanager'),
(5, 'lord', 'lord', 'lord@gmail.com', 'hmanager'),
(6, 'spa', 'spa', 'spa@gmail.com', 'hmanager'),
(7, 'celon', 'celon', 'celon@gmail.com', 'user'),
(8, 'niraj', 'niraj', 'niraj@gmail.com', 'user'),
(9, 'jampa', 'jampa', 'jampa@gmail.com', 'hmanager'),
(10, 'apsara', 'apsara', 'apsara@gmail.com', 'hmanager'),
(11, 'portland', 'portland', 'portland@gmail.com', 'hmanager'),
(12, 'national', 'national', 'national@gmail.com', 'hmanager'),
(13, 'tigertops', 'tigertops', 'tigertops@gmail.com', 'hmanager'),
(14, 'countryVilla', 'countryVilla', 'countryVilla@gmail.com', 'hmanager'),
(15, 'himalayan', 'himalayan', 'himalayan@gmail.com', 'hmanager'),
(16, 'layaku', 'layaku', 'layaku@gmail.com', 'hmanager'),
(17, 'inn', 'inn', 'inn@gmail.com', 'hmanager'),
(18, 'roshan', 'roshan', 'roshan@gmail.com', 'user'),
(19, 'upadesh', 'upadesh', 'upadesh@gmail.com', 'user'),
(20, 'buddhamaya', 'buddhamaya', 'buddhamaya@gmail.com', 'hmanager'),
(21, 'ananda', 'ananda', 'ananda@gmail.com', 'hmanager'),
(22, 'princess', 'princess', 'princess@gmail.com', 'hmanager'),
(23, 'depche', 'depche', 'depche@gmail.com', 'hmanager'),
(24, 'raman', 'raman', 'raman@gmail.com', 'user'),
(25, 'jumanji', 'jumanju', 'jumanji@gmail.com', 'user'),
(26, 'aaa', 'aaa', 'aaa@gmail.com', 'user'),
(27, 'prabek', 'prabek', 'prabek@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `bid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fname` text NOT NULL,
  `rid` bigint(20) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `hid` bigint(20) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `checked_in` varchar(255) NOT NULL,
  `checked_out` varchar(255) NOT NULL,
  `days` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `adate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `username`, `fname`, `rid`, `room_no`, `hid`, `contact`, `email`, `checked_in`, `checked_out`, `days`, `amount`, `adate`) VALUES
(14, 'user', 'user', 12, 'Room-1', 2, 98392842, 'user@gmail.com', '2022-05-19', 'cancelled', 7, 7000, '2022-05-18 14:21:09'),
(15, 'user', 'Englishcha', 12, 'Room-1', 2, 99823839, 'safll@gmail.com', '2022-08-10', '0', 2, 2000, '2022-08-09 15:16:51'),
(16, 'user', 'ajsdflkdsajf', 13, 'Room-2', 2, 839203, 'askjdf@fakjdl', '2022-08-16', 'cancelled', 3, 6000, '2022-08-14 10:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` text NOT NULL,
  `cimg` text NOT NULL,
  `cprice` varchar(20) NOT NULL,
  `hid` bigint(20) NOT NULL,
  `cdesc` text NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `cname`, `cimg`, `cprice`, `hid`, `cdesc`) VALUES
(12, 'Single Bed Room', 'categories7432454.jpg', '1000', 2, 'This room consists of only one bed room.'),
(13, 'Double Bed Room', 'categories912716.jpg', '2000', 2, 'This room consists of only double bed room.'),
(14, 'Deluxe Room', 'categories4861003.jpg', '2500', 2, 'This room has so many facilities.');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
CREATE TABLE IF NOT EXISTS `hotels` (
  `hid` bigint(20) NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(255) NOT NULL,
  `hotel_img` varchar(255) NOT NULL,
  `hotel_desc` text NOT NULL,
  `hotel_address` varchar(255) NOT NULL,
  `manager` text NOT NULL,
  `active` text NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hid`, `hotel_name`, `hotel_img`, `hotel_desc`, `hotel_address`, `manager`, `active`) VALUES
(2, 'The Soaltee', 'hotel2649189.jpg', 'An exceptional blend of royal and traditional elegance, The Soaltee Kathmandu Nepalï¿½s premier 5 Star hotel is set in lush green 12 acres of landscaped area with a magnificent view of the Himalayas.', 'Tahachal Marg, Kathmandu', 'hotel', 'yes'),
(3, 'Hyatt Regency', 'hotel7455683.jpg', 'Hyatt Regency Kathmandu is a 5 star luxury hotel and resort in Kathmandu and is set on 37 acres of landscaped grounds, created in the traditional Newari style of Nepalese architecture.', 'Kathmandu', 'manager', 'yes'),
(5, 'Diyalo Lords Plaza', 'hotel452411.jpg', 'Diyalo Lords Plaza is a upscale smart and contemporaneity hotel located in the heart of the Industrial City of Birgunj, within easy access from major corporate business and government entities.', 'Birgunj', 'lord', 'yes'),
(7, 'Hotel Middle Path & Spa ', 'hotel442494.jpg', 'Set just a 5-minute walk from the beautiful Phewa Lake, Hotel Middle Path & Spa offers clean and comfortable rooms with views. Complimentary WiFi access is available. Very friendly staff, beautiful rooms, close by to the lake, good breakfast.', 'Pokhara', 'spa', 'yes'),
(8, 'Hotel Jamapa', 'hotel4840278.jpg', 'Hotel Jampa is set in Thamel and provides air-conditioned rooms with free WiFi. The property is 2.9 km from Kathmandu Durbar Square and 3.1 km from Swayambhunath Temple.\r\n\r\nAll units in the hotel are fitted with a flat-screen TV with satellite channels. Rooms are fitted with a private bathroom and a shower, and selected rooms here will provide you with a terrace. At Hotel Jampa, every room is equipped with a seating area.\r\n\r\nThe accommodation offers a continental or buffet breakfast. There is an in-house restaurant, which serves International cuisine and also offers vegetarian options.\r\n\r\nHotel Jampa provides an ironing service, as well as business facilities like fax and photocopying. With staff speaking English and Hindi, around the clock advice is available at the reception.\r\n\r\nPashupatinath is 5 km from the hotel.', 'Bhagwati Marg , Kathmandu', 'jampa', 'yes'),
(9, 'Apsara Boutique Hotel', 'hotel2211068.jpg', 'Apsara Boutique Hotel is located in Kathmandu, 1.4 km from Hanuman Dhoka and 1.5 km from Kathmandu Durbar Square. The hotel has a terrace and views of the mountains. Free WiFi is provided throughout the property and free private parking is available on site.\r\n\r\nRooms have a flat-screen TV. Some rooms include a seating area to relax in after a busy day. A terrace or balcony are featured in certain rooms. The rooms have a private bathroom. For your comfort, you will find bath robes, slippers and free toiletries.\r\n\r\nThere is free airport shuttle service at the property.\r\n\r\nGuests can enjoy a meal at the on-site restaurant, followed by a drink at the bar. The property also offers room service and packed lunches.\r\n\r\nThe hotel also offers bike hire and car hire. Swayambhu is 2.1 km from Apsara Boutique Hotel, while Pashupatinath is 3.5 km from the property. The nearest airport is Tribhuvan Airport, 5 km from the property.', 'Thamel , Kathmandu', 'apsara', 'yes'),
(10, 'Hotel Portland', 'hotel9748729.jpg', 'Set in Pokhara, 300 m from Fewa Lake, Hotel Portland offers air-conditioned rooms and a bar. Among the facilities of this property are a restaurant, a 24-hour front desk and room service, along with free WiFi. The property is non-smoking and is located 11 km from World Peace Pagoda.\r\n\r\nAt the hotel, all rooms come with a desk, a flat-screen TV and a private bathroom. The units will provide guests with a wardrobe and a kettle.\r\n\r\nHotel Portland offers a continental or buffet breakfast.\r\n\r\nThe accommodation offers a terrace. Cycling is among the activities that guests can enjoy near Hotel Portland.\r\n\r\nGuests can rent a bike or a car to explore the area, make use of the business centre, or read the newspapers available on site.\r\n\r\nInternational Mountain Museum is 6 km from the hotel, while Mahendra Cave is 10 km away.', 'Lakeside Road, Pokhara', 'portland', 'yes'),
(11, 'Hotel National Park', 'hotel181096.jpg', 'Featuring free WiFi and a barbecue, Hotel National Park Sauraha offers accommodation in Sauraha, 10 minute walk to the banks of the Rapti River. The property is a 10-minute walk from Chitwan National Park Entrance. The hotel has a terrace offering sunset views. Free private parking is available on site.\r\n\r\nAll units have a private bathroom with slippers. Towels are featured.\r\n\r\nThere is room service at the property. Bike hire and car hire are available at this hotel and the area is popular for cycling and canoeing. Chitwan National Park activities can be arranged along with tourist bus tickets to Kathmandu, Pokhara and Lumbini.\r\n\r\nSauraha Bus Station is 1 km away while the Bharatpur Airport is 20 km away. Hotel National Park support animal rights and freedom so safari with elephant is not available.\r\n\r\nHotel has a great view from the room. Guest can enjoy watching mountain, Sunrise, sunset from the hotel.\r\n\r\nBalcony in the hotel is shared balcony.', 'Chitwan National Park, Sauraha', 'national', 'yes'),
(12, 'Hotel Country Villa', 'hotel6205408.jpg', 'Offering a restaurant that serves Indian and International delights, Hotel Country Villa is situated 2,195 m above sea level, spread in 2.51 acres of land. Free WiFi access is available in the public areas of the property.\r\n\r\nEach room here will provide you with a satellite TV and a seating area. Featuring a shower, private bathroom also comes with free toiletries.\r\n\r\nAt Hotel Country Villa you will find a 24-hour front desk, a garden and a terrace. Other facilities offered at the property include a shared lounge, a ticket service and a tour desk. The property offers free parking.\r\n\r\nChangu Narayan Temple is 14 km and the Bhaktapur Durbar Square is 20 km. The Kamal Binayak Bhaktapur Bus Station is 20 km and the Tribhuvan Airport is 30 km away.', 'Naldum Road, Nagarkot', 'countryVilla', 'yes'),
(13, 'Hotel Himalayan Villa', 'hotel9689153.jpg', 'Offering a restaurant that serves Indian and International delights, Hotel Himalayan Villa is situated 2,195 m above sea level, spread over 2 acres of land. Free WiFi access is available in the all areas of the property.\r\n\r\nEach room here will provide you with air conditioner room,great mountain view a satellite TV and a seating area, private balcony. Featuring tea coffee maker a shower, private bathroom, also comes with free toiletries,hair dryer and slippers.\r\n\r\nAt Hotel Himalayan Villa you will find a room service, laundry and a terrace. Other facilities offered at the property include a shared lounge, a ticket service and a tour desk. The property offers free parking.\r\n\r\nView Tower is 4 km, Changu Narayan Temple is 14 km and Bhaktapur Durbar Square is 20 km. Kamal Binayak Bhaktapur Bus Station is 20 km and Tribhuvan Airport is 28 km away', 'Naldum, Nagarkot', 'himalayan', 'yes'),
(14, 'Hotel Layaku Durbar', 'hotel4913034.jpg', 'Situated at Yalachhen - 2, Bhaktapur Durbar Square, HOTEL LAYAKU DURBAR has a terrace. This 3-star hotel offers a 24-hour front desk and free WiFi. Each room is fitted with a patio.\r\n\r\nThe rooms at the hotel are equipped with a seating area. All rooms are equipped with a kettle, while some have a balcony. Guest rooms will provide guests with a toaster.\r\n\r\nAn American or Asian breakfast can be enjoyed at the property.', 'Yalachhen-2 , Bhaktapur', 'layaku', 'yes'),
(15, 'Inn Sangrahalaya', 'hotel2965564.jpg', 'Inn Sangrahalaya is located in Bhaktapur, 60 m from Bhaktapur Durbar Square, and features a bar, a shared lounge and a terrace. Among the facilities of this property are a restaurant, a 24-hour front desk and room service, along with free WiFi throughout the property. The accommodation provides luggage storage space, and currency exchange for guests.\r\n\r\nAt the hotel, each room is fitted with a wardrobe. Rooms come complete with a private bathroom equipped with a shower and slippers, while certain rooms at Inn Sangrahalaya also provide guests with a seating area. At the accommodation every room is equipped with bed linen and towels.\r\n\r\nA continental breakfast is available daily at Inn Sangrahalaya.', 'Balakhu Ganesh Durbar Square, Bhaktapur', 'inn', 'yes'),
(16, 'Budhha Maya Garden', 'hotel1055003.jpg', 'Buddha Maya Garden by KGH Group is located within the Lumbini Heritage Site, about 13 km from Gautam Buddha Airport. It offers free parking and an international restaurant.\r\n\r\nRooms at Buddha Maya Garden by KGH Group feature both air conditioning and ceiling fans. Each comes with a cable TV and slippers. Private balconies overlook the surrounding landscapes.\r\n\r\nGuests may rent a car to explore the area or arrange day trips at the tour desk. The hotel also provides a business centre and laundry services.', 'Kapilvastu, Lumbini', 'buddhamaya', 'yes'),
(17, 'Hotel Ananda Inn', 'hotel7902988.jpg', 'Hotel Ananda Inn is set in Lumbini and has a bar, a garden and a terrace. Among the facilities of this property are a restaurant, a 24-hour front desk and room service, along with free WiFi throughout the property. Free private parking is available and the hotel also offers car hire for guests who want to explore the surrounding area.\r\n\r\nAt the hotel, the rooms are equipped with a wardrobe. The private bathroom is fitted with a shower, slippers and free toiletries. All guest rooms at Hotel Ananda Inn feature air conditioning and a desk.\r\n\r\nContinental and buffet breakfast options are available every morning at the accommodation.', 'Mahilivar, Lumbini', 'ananda', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `rid` bigint(11) NOT NULL AUTO_INCREMENT,
  `id` bigint(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `hid` bigint(20) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rid`, `id`, `rate`, `hid`) VALUES
(8, 7, '3', 3),
(2, 2, '2', 2),
(9, 2, '4', 3),
(7, 7, '4', 5),
(10, 7, '3', 10),
(11, 7, '5', 12),
(12, 18, '4', 9),
(13, 18, '4', 3),
(14, 19, '4', 15),
(15, 19, '3', 14),
(16, 19, '3', 8),
(17, 24, '3', 17),
(18, 24, '2', 16),
(19, 24, '5', 2),
(20, 2, '3', 9),
(21, 2, '3', 15),
(22, 8, '4', 12),
(23, 2, '4', 12),
(24, 2, '3', 10),
(25, 26, '4', 3),
(26, 1, '4', 12),
(27, 27, '4', 3),
(28, 27, '5', 12);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `rid` bigint(20) NOT NULL AUTO_INCREMENT,
  `room` varchar(30) NOT NULL,
  `cid` bigint(20) NOT NULL,
  `cname` text NOT NULL,
  `hid` bigint(20) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`rid`, `room`, `cid`, `cname`, `hid`, `status`) VALUES
(12, 'Room-1', 12, 'Single Bed Room', 2, 'no'),
(16, 'Room-5', 14, 'Deluxe Room', 2, 'yes'),
(13, 'Room-2', 13, 'Double Bed Room', 2, 'yes'),
(14, 'Room-3', 12, 'Single Bed Room', 2, 'yes'),
(15, 'Room-4', 13, 'Double Bed Room', 2, 'yes'),
(17, 'Room-6', 14, 'Deluxe Room', 2, 'yes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
