import os
from dotenv import load_dotenv
import sys
import smtplib
import ssl
from email.message import EmailMessage
import psycopg2
from psycopg2 import sql
import secrets

# Cargar las variables de entorno
def load_token_env():
    from ..utils.env_loader import load_env
    load_env()
load_token_env(dotenv_path='../config/.env')

email_sender = 'lostpaws7@gmail.com'
email_password = os.getenv('EMAIL_PASSWORD')
email_receiver = sys.argv[1]

# Conectar a la base de datos
try:
    conn = psycopg2.connect(
        host=os.getenv("DB_HOST"),
        database=os.getenv("DB_NAME"),
        user=os.getenv("DB_USER"),
        password=os.getenv("DB_PASS")
    )
    cursor = conn.cursor()
    print("Conexión a la base de datos exitosa")
except (Exception, psycopg2.Error) as error:
    print(f"Error al conectar a la base de datos: {error}")
    sys.exit(1)

# Generar token de acceso
token = secrets.token_urlsafe(32)

# Actualizar token en la base de datos
try:
    cursor.execute(sql.SQL("UPDATE usuario SET token = %s WHERE correo = %s"), (token, email_receiver))
    conn.commit()
    print("Token actualizado exitosamente")
except (Exception, psycopg2.Error) as error:
    print(f"Error al actualizar el token: {error}")
    sys.exit(1)

# Enviar el correo electrónico
subject = 'Token de Acceso Lost Paws'
body = f"""
Tu token de acceso es: {token}
"""

em = EmailMessage()
em['From'] = email_sender
em['To'] = email_receiver
em['Subject'] = subject
em.set_content(body)

context = ssl.create_default_context()
try:
    with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
        smtp.login(email_sender, email_password)
        smtp.sendmail(email_sender, email_receiver, em.as_string())
    print("Correo enviado exitosamente")
except Exception as e:
    print(f"Error al enviar el correo: {e}")
    sys.exit(1)