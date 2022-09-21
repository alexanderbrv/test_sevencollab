# Result table
id, name, user kits, document sum<br>
1, first_name_1 last_name_1, 6, 10<br>
2, first_name_2 last_name_2, 3, 10<br>
3, first_name_3 last_name_3, 6, 10<br>
4, first_name_4 last_name_4, 3, 10<br>
6, first_name_6 last_name_6, 1, 10<br>
8, first_name_8 last_name_8, 5, 10<br>
9, first_name_9 last_name_9, 3, 10<br>

# Below is queries for solution
-- Solution
```
SELECT u.id, CONCAT(u.first_name, ' ', u.last_name), user_kits, sum
FROM users u
    JOIN (SELECT user_id, COUNT(*) as user_kits
        FROM user_kits
        GROUP BY user_id) AS uk
        ON u.id = uk.user_id
    JOIN (SELECT user_id, SUM(array_length(used_items, 1) * per_items) as sum
        FROM documents
        GROUP BY user_id) AS d
        ON u.id = d.user_id
WHERE sum > user_kits;
```

-- Query for getting documents sum by each user
```
SELECT user_id, SUM(array_length(used_items, 1) * per_items) as sum
FROM documents
GROUP BY user_id
ORDER BY user_id;
```

-- Query for getting user kits
```
SELECT user_id, COUNT(*) as user_kits
FROM user_kits
GROUP BY user_id
ORDER BY user_id;
```

-- Alternative solution query
```
SELECT u.id, CONCAT(u.first_name, ' ', u.last_name)
FROM users u
WHERE (
    SELECT SUM(array_length(used_items, 1) * per_items)
    FROM documents d
    WHERE d.user_id = u.id
    GROUP BY user_id
) > (
    SELECT COUNT(*)
    FROM user_kits uk
    WHERE uk.user_id = u.id
    GROUP BY user_id
);
```
