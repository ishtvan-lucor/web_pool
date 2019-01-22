SELECT UPPER(`last_name`) AS 'NAME', `first_name`, `price` FROM `user_card`
INNER JOIN `member` ON user_card.id_user = member.id_user_card
INNER JOIN `subscription` on subscription.id_sub = member.id_sub 
WHERE subscription.price > 42
ORDER BY user_card.last_name, user_card.first_name;
