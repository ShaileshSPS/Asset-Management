
CREATE TABLE `user_info` (
  `user_id` int(4) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(40) NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `country` varchar(20) NOT NULL,
  `path` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);


ALTER TABLE `user_info`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

