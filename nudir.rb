#!/usr/bin/ruby

require 'rubygems'
require 'open-uri'
require 'nokogiri'
require 'cgi'

name = "Cary Lee"


def lookup( name )
  encodedName = CGI::escape(name)
  url = "http://directory.northwestern.edu/index.cgi?a=1&name=" + encodedName

  doc = Nokogiri::HTML(open(url))

  #rows = doc.xpath('/html/body/div/div')[1].xpath('table/tr')


  #rows.each do |row|
  #  if row.css('td')[0].attr('valign')
  #    puts row.css('td b')[0].content
  #    if row.css('td a')[1]
  #      puts row.css('td a')[1].content
  #    end
  #    puts row.css('td')[1].content
  #    puts row.css('td')[2].content
  #  end
  #end

  firstResult = doc.xpath('/html/body/div/div')[1].xpath('table/tr')[1]

  name = firstResult.css('td b')[0].content
  email = firstResult.css('td a')[1].content
  phone = firstResult.css('td')[1].content
  address = firstResult.css('td')[2].content

  info = {'name' => name, 'email'=> email, 'phone'=>phone, 'address'=>address }
  return info
end

info = lookup(name)
puts info

