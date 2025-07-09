package com.greeting;

import java.io.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/GreetServlet")
public class GreetServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        String name = request.getParameter("name");

        response.setContentType("text/html");

        PrintWriter out = response.getWriter();
        out.println("<!DOCTYPE html>");
        out.println("<html lang='en'>");
        out.println("<head>");
        out.println("<meta charset='UTF-8'>");
        out.println("<title>Greeting</title>");
        out.println("<style>");
        out.println("body {");
        out.println("  font-family: 'Segoe UI', sans-serif;");
        out.println("  background: linear-gradient(to right, #fc466b, #3f5efb);");
        out.println("  display: flex;");
        out.println("  justify-content: center;");
        out.println("  align-items: center;");
        out.println("  height: 100vh;");
        out.println("  margin: 0;");
        out.println("  color: white;");
        out.println("}");
        out.println(".card {");
        out.println("  background-color: rgba(0,0,0,0.7);");
        out.println("  padding: 40px;");
        out.println("  border-radius: 15px;");
        out.println("  text-align: center;");
        out.println("  box-shadow: 0 0 15px rgba(0,0,0,0.5);");
        out.println("}");
        out.println("h1 { font-size: 32px; }");
        out.println("</style>");
        out.println("</head>");
        out.println("<body>");
        out.println("<div class='card'>");
        out.println("<h1>Hello, " + name + "!</h1>");
        out.println("</div>");
        out.println("</body>");
        out.println("</html>");
    }
}
