use coolfreeze_db

INSERT INTO users (role, username, email, password_hash)
VALUES ('admin', 'admin', 'admin@coolfreeze.com', '$2b$12$m7OQpQQmOdVFXGq/hi3Qg.cEqviZwSqlBhtPXmVzAp37GCqbsZn7S');
-- Password: Password123


INSERT INTO admins (user_id, full_name)
VALUES (LAST_INSERT_ID(), 'Admin Name');