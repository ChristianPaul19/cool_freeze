-- =========================================================
-- CoolFreeze Airconditioning Management System
-- Sample data for `customers`
-- Run this AFTER customers_from_form.sql has created the table.
--
-- Note: the password_hash values below are all a real bcrypt
-- hash of the plain-text password "Password123" — verified to
-- work with PHP's password_verify(), useful for testing your
-- login form locally.
-- =========================================================

use coolfreeze_db

INSERT INTO customers (username, email, phone, password_hash, agreed_to_terms) VALUES
('mark_borito', 'mark.borito@example.com', '09171234567', '$2b$12$m7OQpQQmOdVFXGq/hi3Qg.cEqviZwSqlBhtPXmVzAp37GCqbsZn7S', 1),
('richmond_quizon',  'richmond.quizon@example.com',  '09179876543', '$2b$12$m7OQpQQmOdVFXGq/hi3Qg.cEqviZwSqlBhtPXmVzAp37GCqbsZn7S', 1),
('christian_repol',   'christian.repol@example.com',   '09203119233', '$2b$12$m7OQpQQmOdVFXGq/hi3Qg.cEqviZwSqlBhtPXmVzAp37GCqbsZn7S', 1),
('matt_legaspi',   'matt.legaspi@example.com',   '09205116233', '$2b$12$m7OQpQQmOdVFXGq/hi3Qg.cEqviZwSqlBhtPXmVzAp37GCqbsZn7S', 1),
('mark_esguerra',   'mark.esguerra@example.com',   '09207117233', '$2b$12$m7OQpQQmOdVFXGq/hi3Qg.cEqviZwSqlBhtPXmVzAp37GCqbsZn7S', 1),
('mikaela_bernardo',   'mikaela.bernardo@example.com',   '09209912235', '$2b$12$m7OQpQQmOdVFXGq/hi3Qg.cEqviZwSqlBhtPXmVzAp37GCqbsZn7S', 1);