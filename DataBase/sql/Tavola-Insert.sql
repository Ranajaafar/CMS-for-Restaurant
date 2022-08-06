INSERT INTO `admin` (`adminid`, `username`, `password`, `type`) VALUES
(1, 'lynn', '1234', 'superAdmin'),
(2, 'rana', '1234', 'superAdmin'),
(3, 'root', '1278', 'admin');




INSERT INTO `tavola`.`category` (`cat_name`, `cat_photo`) VALUES ('burgers', 'burgerc.png');
INSERT INTO `tavola`.`category` (`cat_name`, `cat_photo`) VALUES ('pizza', 'pizza.jpg');
INSERT INTO `tavola`.`category` (`cat_name`, `cat_photo`) VALUES ('plates', 'plates.png');
INSERT INTO `tavola`.`category` (`cat_name`, `cat_photo`) VALUES ('sandwiches', 'sandwichc.png');
INSERT INTO `tavola`.`category` (`cat_name`, `cat_photo`) VALUES ('pasta', 'pasta.png');




INSERT INTO `rating` (`id`, `nb1`, `nb2`, `nb3`, `nb4`, `nb5`) VALUES(1, 12, 125, 30, 1, 2);
INSERT INTO `tavola`.`rating` (`id`) VALUES ('2');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('3');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('4');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('5');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('6');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('7');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('8');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('9');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('10');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('11');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('12');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('13');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('14');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('15');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('16');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('17');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('18');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('19');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('20');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('21');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('22');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('23');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('24');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('25');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('26');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('27');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('28');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('29');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('30');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('31');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('32');
INSERT INTO `tavola`.`rating` (`id`) VALUES ('33');




INSERT INTO `currency` (`name`, `symbole`, `equal`) VALUES
('dollar', '$', 1),
('lira', 'L.L', 21000),
('euro', '€', 1.08);




INSERT INTO `tavola`.`offer` (`discount`) VALUES ('12');
INSERT INTO `tavola`.`offer` (`discount`) VALUES ('10');
INSERT INTO `tavola`.`offer` (`discount`) VALUES ('20');
INSERT INTO `tavola`.`offer` (`discount`) VALUES ('5');



INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`, `offer_id`) VALUES ('Mozzarella Chicken Burger', '120g grilled chicken breast, breaded mozzarella, lettuce, tomato, pickles, aiole sauce', '15.4', '4', '1', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('BBQ Beef Burger', '130g beef, fried onion, smoked turkey, lettuce, pickles, cheddar cheese, mayo, BBQ sauce', '17', '5', '1');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('La Tavola Chicken Burger', '130g Breaded fried chicken stuffed with mozzarella cheese, cheddar cheese, pickles, lettuce, tomato, la tavola sauce. Served in freshly baked La Tavola bun', '15', '6', '1');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Zinger Burger', 'Fried crispy chicken, jalapenoes, lettuce, pickles, mayo sauce', '10', '7', '1');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`, `offer_id`) VALUES ('La Tavola Beef Burger', '130g Double beef, onion, mushroom, swiss cheese, la tavola sauce & mushroom sauce Served in freshly baked La Tavola bread', '27.4', '8', '1', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('La Tavola Joppie Chicken', 'La Tavola special fries topped with 200g fried breaded chicken, cheddar cheese, spicy sauce & la tavola sauce', '18', '9', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Special Cordon Bleu', 'Deep-fried chicken stuffed with mozzarella cheese, topped with mozzarella cheese, cheddar & mushroom served with wedges, ceasar salad and BBQ', '21', '10', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`, `offer_id`) VALUES ('Salmon', '225g grilled salmon served with grilled veggies & tartar sauce', '33.3', '11', '3', '1');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`, `offer_id`) VALUES ('Steak Pepper Sauce', '200g Steak, desmolase pepper sauce, grilled veggies, served with wedges - Change wedges to mashed potato 5000 L.L', '30', '12', '3', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Pollo Al Funghi', '200g grilled chicken, white mushroom sauce, mushroom served with wedges & fettuccine - Change to Veggies 4,000LL', '21.3', '13', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`, `offer_id`) VALUES ('Scallopini Pomodora – Meat', '150g breaded fried meat with parmesan, cherry tomatoes, tomato sauce, served with terlato pasta', '28', '14', '3', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Scallopini Pomodora – chicken', 'Chicken escalope with parmesan, cherry tomatoes, tomato sauce, served with terlato pasta', '21.6', '15', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Fish Lemon', 'Fish fillet, grilled veggies, mashed potatoes served with lemon sauce', '19.3', '16', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Chicken Escalope', 'Deep fried breaded chicken, french fries & coleslaw, served with cocktail sauce', '17', '17', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Crispy', 'Five pieces of crunchy chicken strips, coleslaw & french fries served with cocktail sauce', '17', '18', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('B.B.Q chicken with rice', 'Marinated grilled chicken, with mexican rice, grilled vegetables, & a side green salad.', '20', '19', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`, `offer_id`) VALUES ('1/2 Grilled Farouj Msahab', 'Half charcoal grilled farouj served with garlic dip, pickles & french fries', '22', '20', '3', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Mexican Chicken with Rice', '200g grilled chicken, mixed pepper, onion, mexican sauce with vegetable mexican rice. - Change to Shrimps', '20', '21', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Scallopini Artichoke – Chicken', '150g breaded fried chicken, artichoke sauce, topped with mozzarella cheese served with caesar salad & french fries.', '30', '22', '3');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Chicken Pizza', 'Cheese, tomato sauce, grilled chicken & mixed pepper', '23', '23', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Steak Pizza', 'Cheese, tomato sauce, steak & mixed pepper', '27', '24', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Mixed Cheese', 'Mozzarella, parmesan, fetta, emmental cheese & tomato sauce', '21.7', '25', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Margherita', 'Cheese & tomato sauce', '21.7', '26', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Pepperoni', 'Cheese, tomato sauce, & pepperoni', '27', '27', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Vegetarian Pizza', 'Cheese, tomato sauce, mushroom, artichoke & mixed pepper', '22.67', '28', '2');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Cheesy Fillet Steak Sand (Philadelphia)', 'Grilled Steak, onion, mixed pepper, mushroom, mozzarella cheese, mayo sauce', '17', '29', '4');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Roman Chicken Pesto Sand', 'Our ciabatta bread, grilled chicken, rocca, cherry tomatoes, pickles, pesto sauce', '12', '30', '4');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Mountry Jack Sand', '120g grilled checken breast, fried onion rings, lettuce, pickles,smoked turkey, cheddar cheese, mayo, BBQ sauce, served with shabata bread', '16', '31', '4');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Honey Mustard Sand', 'Honey Mustard Sand 120g breaded chicken, lettuce, pickles, tomato, mayo, honey mustard sauce, served in shabata bread', '11', '32', '4');
INSERT INTO `tavola`.`item` (`pname`, `description`, `price`, `rat_id`, `cat_id`) VALUES ('Special La Tavola Sand', '120g grilled chicken breast, tortilla chips, green pepper, onion, mozzarella cheese, mayo, special sauce.', '16', '33', '4');




INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Mozzarella-chicken-burger.jpg', '1');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('BBQ-Beef-Burger.jpg', '2');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('la-tavola-chicken-burger.jpg', '3');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('la-tavola-beef-burger.jpg', '5');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('la-tavola-joppie-chicken.jpg', '6');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('special-cordon-bleu.jpg', '7');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('salmon.jpg', '8');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('steak-pepper-sauce.jpg', '9');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('pollo-al-funghi.jpg', '10');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('scallopini-pomodora-meat.jpg', '11');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('scallopini-pomodora-chicken.jpg', '12');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('fish-lemon.jpg', '13');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('chicken-escalope.jpg', '14');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('crispy.jpg', '15');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('b.b.q-chicken-with-rice.jpg', '16');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('half-farouj-msahab.jpg', '17');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('mexican-chicken-with-rice.jpg', '18');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('scallopini-artichoke-chicken.jpg', '19');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Chicken.jpg', '20');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Steak.jpg', '21');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Mixed-Cheese.jpg', '22');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Margherita.jpg', '23');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('pepporoni.jpg', '24');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Vegetarian.jpg', '25');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('cheesy-fillet-steak-sand-philadelphia.jpg', '26');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Roman-Chicken-Pesto-Sand-scaled.jpg', '27');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Mountry-Jack-Snd.jpg', '28');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Honey-Mustard-Sand.jpg', '29');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('Special-La-Tavola-Sand.jpg', '30');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('crispy1.jpg', '15');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('pollo-al-funghi2.jpg', '10');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('special-cordon-bleu2.jpg', '7');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('zinger_burger.jpg', '4');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('zinger_burger1.jpg', '4');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('zinger_burger2.jpg', '4');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('zinger_burger3.jpg', '4');
INSERT INTO `tavola`.`photo` (`photo_path`, `pid`) VALUES ('zinger_burger4.jpg', '4');



INSERT INTO `tavola`.`discount` (`pourcentage`, `unicode`) VALUES ('8', 'Rana_Lynn12');
INSERT INTO `tavola`.`discount` (`pourcentage`, `unicode`) VALUES ('2', 'ex');



INSERT INTO `tavola`.`feedback` (`name`, `commentaire`, `date`) VALUES ('Joe doe', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam hic magnam fugit exercitationem neque, quae laboriosam natus. Ut maxime assumenda facere ea quasi accusamus dolores delectus tempora animi, expedita iste', '2022-1-1');
INSERT INTO `tavola`.`feedback` (`name`, `commentaire`, `date`) VALUES ('john deeb', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora sit', '2022-2-2');
INSERT INTO `tavola`.`feedback` (`name`, `commentaire`, `date`) VALUES ('jury ', 'consectetur adipisicing elit. Enim animi atque numquam harum libero nemo, eligendi laboriosam beatae quo iure corrupti, neque rerum possimus non nisi quia! Cumque, tempora', '2022-4-5');




INSERT INTO `tavola`.`extra` (`name`, `price`) VALUES ('ex', '0');
INSERT INTO `tavola`.`extra` (`name`, `price`) VALUES ('Cheese', '2.6');
INSERT INTO `tavola`.`extra` (`name`, `price`) VALUES ('AVOCADO', '5');
INSERT INTO `tavola`.`extra` (`name`, `price`) VALUES ('BBQ', '1');
INSERT INTO `tavola`.`extra` (`name`, `price`) VALUES ('Mayo Garlic', '1');
INSERT INTO `tavola`.`extra` (`name`, `price`) VALUES ('Honey Mustard', '1');
INSERT INTO `tavola`.`extra` (`name`, `price`) VALUES ('Ketchup', '1');

INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('2', '1');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('3', '1');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('4', '1');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('5', '1');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('6', '1');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('7', '1');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('2', '4');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('3', '4');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('4', '4');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('5', '4');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('6', '4');
INSERT INTO `tavola`.`have` (`id_extra`, `cat_id`) VALUES ('7', '4');

INSERT INTO `tavola`.`restaurant_info` (`tablenb`, `chairnb`) VALUES ('10', '6');