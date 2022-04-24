import os
import subprocess

from flask import Flask, render_template, request, redirect, url_for
from flaskext.markdown import Markdown

app = Flask(__name__)
Markdown(app)


def write_page(filename, text):
    with open(f'pages/{filename}', "w") as f:
        f.write(text)


@app.route('/')
def index():
    return render_template("index.html", text="wiki")


@app.route('/pages')
def pages():
    query = request.args.get("q", "")
    if query == "":
        _pages = os.listdir('pages/')
        return render_template("pages_list.html", pages=_pages)
    _pages = subprocess.getoutput(f"ls pages/ | grep {query}").split()
    error = ""
    if not _pages:
        error = f'Не удалось найти страницы по запросу: "{query}"'
    return render_template("pages_list.html", search_query=query, pages=_pages, error=error)


@app.route('/pages/show/<page_id>')
def show_pages(page_id):
    page = subprocess.getoutput(f"cat pages/{page_id}")
    print(page)
    return render_template("page.html", text=page, page_id=page_id)


@app.route('/pages/add', methods=['GET', 'POST'])
def add_pages():
    if request.method == "POST":
        filename = request.form.get("filename")
        text = request.form.get("text")
        if filename == '':
              return render_template('edit_page.html', error="Empty filename")

        write_page(filename, text)
        return redirect(url_for('show_pages', page_id=filename))
    return render_template('edit_page.html')


@app.route('/pages/update/<page_id>', methods=['GET', 'POST'])
def update_pages(page_id):
    if request.method == 'POST':
        new_text = request.form.get("text")
        write_page(page_id, new_text)
        return redirect(url_for('show_pages', page_id=page_id))
    text = subprocess.getoutput(f"cat pages/{page_id}")
    return render_template('edit_page.html', text=text, filename=page_id)


@app.route('/pages/delete/<page_id>')
def delete_pages(page_id):
    os.remove(f"pages/{page_id}")
    return redirect(url_for('pages'))


if __name__ == '__main__':
    app.run(host="0.0.0.0", debug=True)
