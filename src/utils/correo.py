import os
from dotenv import load_dotenv
import sys
import smtplib
import ssl
from email.message import EmailMessage
import psycopg2
from psycopg2 import sql
import random
import string

# Cargar las variables de entorno
load_dotenv(dotenv_path='../config/.env')

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

# Generar código de recuperación
codigo = ''.join(random.choices(string.ascii_uppercase + string.digits, k=6))

# Actualizar código en la base de datos
try:
    cursor.execute(sql.SQL("UPDATE usuario SET codigo = %s WHERE email = %s"), (codigo, email_receiver))
    conn.commit()
    print("Código actualizado exitosamente")
except (Exception, psycopg2.Error) as error:
    print(f"Error al actualizar el código: {error}")
    sys.exit(1)

# Enviar el correo electrónico
subject = 'Recuperación Contraseña Lost Paws'
body = f"""
Tu código de recuperación es: {codigo}
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
