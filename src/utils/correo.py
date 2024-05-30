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
# load_dotenv()
load_dotenv(dotenv_path='../config/.env')
email_sender = 'lostpaws7@gmail.com'
email_password = os.getenv('EMAIL_PASSWORD')
email_receiver = sys.argv[1]
conn=psycopg2.connect(
    host=os.getenv("DB_HOST"),
    database=os.getenv("DB_NAME"),
    user=os.getenv("DB_USER"),
    password=os.getenv("DB_PASS")
)
cursor=conn.cursor()
codigo= ''.join(random.choices(string.ascii_uppercase + string.digits, k=6))
try:
    cursor.execute(sql.SQL("UPDATE usuario SET codigo = %s WHERE email = %s"), (codigo, email_receiver))
    conn.commit()
except(Exception, psycopg2.Error) as error:
    print("Error al actualizar el codigo: ", error)
subject = 'Recuperación Contraseña Lost Paws'

body = """
   Tu código de recuperación es: """ + codigo + """
"""

em = EmailMessage()
em['From'] = email_sender
em['To'] = email_receiver
em['Subject'] = subject
em.set_content(body)

context = ssl.create_default_context()
with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
    smtp.login(email_sender, email_password)
    smtp.sendmail(email_sender, email_receiver, em.as_string())
'lostpaws7@gmail.com'
email_password = 'ckls esbx thkr skae'
