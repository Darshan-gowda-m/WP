package com.request;

import java.io.*;
import java.util.*;
import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/InfoServlet")
public class InfoServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    private void handleRequest(HttpServletRequest request, HttpServletResponse response)
            throws IOException {

        response.setContentType("text/html");
        PrintWriter out = response.getWriter();

        String method = request.getMethod();
        String uri = request.getRequestURI();
        String protocol = request.getProtocol();
        String remoteAddr = request.getRemoteAddr().replace("0:0:0:0:0:0:0:1", "127.0.0.1");
        String userAgent = request.getHeader("User-Agent");
        String contentType = request.getContentType();
        String host = request.getHeader("Host");
        String referer = request.getHeader("Referer");
        int contentLength = request.getContentLength();
        String queryString = request.getQueryString();
        int remotePort = request.getRemotePort();
        int localPort = request.getLocalPort();
        String serverName = request.getServerName();
        String localAddr = request.getLocalAddr();

        out.println("<!DOCTYPE html><html><head><title>Request Info</title>");
        out.println("<style>");
        out.println("body { font-family: Arial; background: #1e272e; color: white; padding: 40px; }");
        out.println(".box { background: rgba(255,255,255,0.1); padding: 30px; border-radius: 10px; }");
        out.println("table { width: 100%; border-collapse: collapse; margin-top: 20px; }");
        out.println("th, td { padding: 8px 12px; border: 1px solid white; }");
        out.println("th { background-color: #485460; }");
        out.println("</style></head><body>");
        out.println("<div class='box'>");
        out.println("<h2>Full Request Information</h2>");
        out.println("<p><strong>Method:</strong> " + method + "</p>");
        out.println("<p><strong>URI:</strong> " + uri + "</p>");
        out.println("<p><strong>Protocol:</strong> " + protocol + "</p>");
        out.println("<p><strong>Remote Address:</strong> " + remoteAddr + ":" + remotePort + "</p>");
        out.println("<p><strong>Local Address:</strong> " + localAddr + ":" + localPort + "</p>");
        out.println("<p><strong>Server Name:</strong> " + serverName + "</p>");
        out.println("<p><strong>Host:</strong> " + host + "</p>");
        out.println("<p><strong>User-Agent:</strong> " + userAgent + "</p>");
        out.println("<p><strong>Content-Type:</strong> " + (contentType != null ? contentType : "N/A") + "</p>");
        out.println("<p><strong>Content-Length:</strong> " + (contentLength != -1 ? contentLength : "N/A") + "</p>");
        out.println("<p><strong>Referer:</strong> " + (referer != null ? referer : "N/A") + "</p>");
        out.println("<p><strong>Query String:</strong> " + (queryString != null ? queryString : "N/A") + "</p>");

        // Request Parameters
        out.println("<h3>Request Parameters</h3>");
        out.println("<table><tr><th>Parameter</th><th>Value</th></tr>");
        for (String param : request.getParameterMap().keySet()) {
            String value = request.getParameter(param);
            out.println("<tr><td>" + param + "</td><td>" + value + "</td></tr>");
        }
        out.println("</table>");

        // Request Headers
        out.println("<h3>Request Headers</h3>");
        out.println("<table><tr><th>Header</th><th>Value</th></tr>");
        Enumeration<String> headerNames = request.getHeaderNames();
        while (headerNames.hasMoreElements()) {
            String name = headerNames.nextElement();
            String value = request.getHeader(name);
            out.println("<tr><td>" + name + "</td><td>" + value + "</td></tr>");
        }
        out.println("</table>");

        out.println("</div></body></html>");
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        handleRequest(request, response);
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        handleRequest(request, response);
    }

    protected void doPut(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        handleRequest(request, response);
    }

    protected void doDelete(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        handleRequest(request, response);
    }
}
