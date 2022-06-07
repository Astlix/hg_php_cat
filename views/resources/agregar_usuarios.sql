
INSERT INTO tblUser
(
  UserName,
  UserPassword,
  UserEmail,
  UserRole,
  FechaCreacion,
  UserNickname,
  cuenta,
  pass1
) 
VALUES 
(
  :name,
  :pass,
  :email,
  :rol,
  :fecha,
  :nickname,
  :cuenta,
  :pass2
)